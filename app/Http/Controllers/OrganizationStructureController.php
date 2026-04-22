<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationStructure;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationMember;

class OrganizationStructureController extends Controller
{
    /* =================================================
     | ADMIN
     |=================================================*/

    public function index()
    {
        $data = OrganizationStructure::with('members')
            ->orderBy('is_active', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // inject hasil tree ke setiap item
        $data->getCollection()->transform(function ($structure) {

            $members = $structure->members->sortBy('order');

            // preview (3 data)
            $previewCount = 0;
            $structure->treePreview = $this->renderTree($members, null, 0, 3, $previewCount);

            // full tree
            $fullCount = 0;
            $structure->treeFull = $this->renderTree($members, null, 0, 999, $fullCount);

            $structure->memberCount = $members->count();

            return $structure;
        });

        return view('admin.organization-structure.index', compact('data'));
    }

    public function create()
    {
        return view('admin.organization-structure.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'                  => 'required|string|max:255',
            'members'                => 'required|array|min:1',
            'members.*.name'         => 'required|string',
            'members.*.position'     => 'required|string',
            'members.*.photo'        => 'nullable|image|max:2048',
            'members.*.parent_index' => 'nullable|integer',
        ]);

        DB::transaction(function () use ($request) {

            $structure = OrganizationStructure::create([
                'name'      => $request->title,
                'status'    => 'approved',
                'user_id'   => auth()->id(),
                'is_active' => false,
            ]);

            $map = [];

            // STEP 1: CREATE SEMUA
            foreach ($request->members as $i => $member) {

                $photoPath = null;
                if (isset($member['photo'])) {
                    $photoPath = $member['photo']->store('organization', 'public');
                }

                $created = OrganizationMember::create([
                    'organization_structure_id' => $structure->id,
                    'name'     => $member['name'],
                    'position' => $member['position'],
                    'photo'    => $photoPath,
                    'order'    => $i,
                    'parent_id'=> null,
                    'level'    => 0,
                ]);

                $map[$i] = [
                    'id'    => $created->id,
                    'level' => 0
                ];
            }

            // STEP 2: SET PARENT + LEVEL
            foreach ($request->members as $i => $member) {

                if (
                    isset($member['parent_index']) &&
                    isset($map[$member['parent_index']])
                ) {
                    $parent = $map[$member['parent_index']];

                    OrganizationMember::where('id', $map[$i]['id'])->update([
                        'parent_id' => $parent['id'],
                        'level'     => $parent['level'] + 1,
                    ]);

                    $map[$i]['level'] = $parent['level'] + 1;
                }
            }
        });

        return redirect()
            ->route('admin.organization-structure.index')
            ->with('success', 'Struktur organisasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $structure = OrganizationStructure::with('members')->findOrFail($id);
        return view('admin.organization-structure.edit', compact('structure'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'                       => 'required|string|max:255',
            'members'                     => 'required|array|min:1',
            'members.*.name'              => 'required|string',
            'members.*.position'          => 'required|string',
            'members.*.photo'             => 'nullable|image|max:2048',
            'members.*.existing_photo'    => 'nullable|string',
            'members.*.parent_index'      => 'nullable|integer',
        ]);

        $structure = OrganizationStructure::with('members')->findOrFail($id);

        DB::transaction(function () use ($request, $structure) {

            // update title
            $structure->update([
                'name' => $request->title
            ]);

            // HANDLE DELETE FOTO LAMA
            $existingPhotos = collect($request->members)
                ->pluck('existing_photo')
                ->filter()
                ->values();

            foreach ($structure->members as $member) {
                if ($member->photo && !$existingPhotos->contains($member->photo)) {
                    Storage::disk('public')->delete($member->photo);
                }
            }

            // DELETE SEMUA MEMBER LAMA
            OrganizationMember::where('organization_structure_id', $structure->id)->delete();

            $map = [];

            // STEP 1: CREATE ULANG
            foreach ($request->members as $i => $member) {

                $photoPath = $member['existing_photo'] ?? null;

                if (isset($member['photo']) && $member['photo'] instanceof \Illuminate\Http\UploadedFile) {
                    $photoPath = $member['photo']->store('organization', 'public');
                }

                $created = OrganizationMember::create([
                    'organization_structure_id' => $structure->id,
                    'name'     => $member['name'],
                    'position' => $member['position'],
                    'photo'    => $photoPath,
                    'order'    => $i,
                    'parent_id'=> null,
                    'level'    => 0,
                ]);

                $map[$i] = [
                    'id'    => $created->id,
                    'level' => 0
                ];
            }

            // STEP 2: SET PARENT + LEVEL
            foreach ($request->members as $i => $member) {

                if (
                    isset($member['parent_index']) &&
                    isset($map[$member['parent_index']])
                ) {
                    $parent = $map[$member['parent_index']];

                    OrganizationMember::where('id', $map[$i]['id'])->update([
                        'parent_id' => $parent['id'],
                        'level'     => $parent['level'] + 1,
                    ]);

                    $map[$i]['level'] = $parent['level'] + 1;
                }
            }
        });

        return redirect()
            ->route('admin.organization-structure.index')
            ->with('success', 'Struktur organisasi berhasil diperbarui');
    }

public function toggleActive($id)
{
    $structure = OrganizationStructure::findOrFail($id);

    if (!$structure->is_active) {

        $activeCount = OrganizationStructure::where('is_active', true)->count();

        if ($activeCount >= 3) {
            return back()->with('error', 'Maksimal 3 struktur yang bisa aktif');
        }

        $structure->update(['is_active' => true]);

    } else {
        $structure->update(['is_active' => false]);
    }

    return back()->with('success', 'Status struktur diperbarui');
}

    public function destroy($id)
    {
        $structure = OrganizationStructure::with('members')->findOrFail($id);

        foreach ($structure->members as $member) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
        }

        $structure->delete();

        return back()->with('success', 'Struktur organisasi berhasil dihapus');
    }

    /* =================================================
     | PUBLIC
     |=================================================*/

public function public()
{
    $structures = OrganizationStructure::with('members')
        ->where('is_active', true)
        ->latest()
        ->take(4) // batas maksimal (opsional)
        ->get();

    return view('public.organization-structure.index', compact('structures'));
}

    /**
     * Render tree view dengan struktur HTML yang benar (UL/LI) dan FOTO
     */
    private function renderTree($members, $parentId = null, $level = 0, $max = 999, &$count = 0)
    {
        // Kelompokkan berdasarkan parent_id
        $grouped = [];
        
        foreach ($members as $member) {
            $pid = $member->parent_id ?? null;
            
            if (!isset($grouped[$pid])) {
                $grouped[$pid] = [];
            }
            
            $grouped[$pid][] = $member;
        }
        
        return $this->buildTreeHtml($grouped, $parentId, $level, $max, $count);
    }
    
    /**
     * Build HTML tree dengan struktur UL/LI yang benar dan MENAMPILKAN FOTO
     */
    private function buildTreeHtml($grouped, $parentId, $level, $max, &$count)
    {
        if (!isset($grouped[$parentId]) || $count >= $max) {
            return '';
        }
        
        $html = '<ul class="tree">';
        
        foreach ($grouped[$parentId] as $member) {
            
            if ($count >= $max) break;
            
            $count++;
            $hasChildren = isset($grouped[$member->id]) && count($grouped[$member->id]) > 0;
            $levelClass = 'level-' . min($level + 1, 4);
            
            $html .= '<li>';
            $html .= '<div class="tree-node-item">';
            
            // FOTO atau ICON (FIXED - FOTO BISA MUNCUL)
            $html .= '<div class="tree-avatar-icon ' . $levelClass . '">';
            if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                // Jika ada foto, tampilkan foto
                $html .= '<img src="' . asset('storage/' . $member->photo) . '" alt="' . e($member->name) . '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">';
            } else {
                // Jika tidak ada foto, tampilkan icon default
                if ($level == 0) {
                    $html .= '<i class="fas fa-user-tie"></i>';
                } elseif ($level == 1) {
                    $html .= '<i class="fas fa-user"></i>';
                } else {
                    $html .= '<i class="fas fa-user-friends"></i>';
                }
            }
            $html .= '</div>';
            
            // Content
            $html .= '<div class="tree-info-content">';
            $html .= '<div class="tree-name-text">' . e(\Illuminate\Support\Str::limit($member->name, 30)) . '</div>';
            $html .= '<div class="tree-position-text">' . e(\Illuminate\Support\Str::limit($member->position, 35)) . '</div>';
            $html .= '</div>';
            
            // Level badge
            $html .= '<div class="tree-level-badge">Level ' . ($level + 1) . '</div>';
            
            $html .= '</div>'; // close tree-node-item
            
            // Render children recursively
            if ($hasChildren && $count < $max) {
                $html .= $this->buildTreeHtml($grouped, $member->id, $level + 1, $max, $count);
            }
            
            $html .= '</li>';
        }
        
        $html .= '</ul>';
        
        return $html;
    }
}