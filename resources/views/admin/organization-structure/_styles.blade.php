{{-- resources/views/admin/organization-structure/_styles.blade.php --}}
<style>
.org-form-container {
    max-width: 860px;
    margin: 0 auto;
}

.org-form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.org-form-header h2 {
    font-size: 22px;
    font-weight: 600;
    color: #333;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
}

.org-form-header h2 i { color: #4361ee; }

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: white;
    color: #666;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s;
}
.btn-back:hover { background: #f8f9fa; color: #333; }

.form-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.section-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    padding-bottom: 14px;
    border-bottom: 1px solid #f0f0f0;
}

.section-header i { color: #4361ee; font-size: 16px; }
.section-header h4 { margin: 0; font-size: 16px; font-weight: 600; color: #333; }

.members-count {
    margin-left: auto;
    font-size: 13px;
    color: #666;
    background: #f8f9fa;
    padding: 4px 10px;
    border-radius: 12px;
}

.form-group { margin-bottom: 18px; }

.form-label {
    display: block;
    font-weight: 500;
    color: #444;
    margin-bottom: 8px;
    font-size: 14px;
}

.required { color: #dc3545; margin-left: 2px; }
.optional { color: #999; font-weight: normal; font-size: 13px; }

.form-control {
    width: 100%;
    padding: 11px 14px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.2s;
    box-sizing: border-box;
}
.form-control:focus {
    outline: none;
    border-color: #4361ee;
    box-shadow: 0 0 0 3px rgba(67,97,238,0.1);
}

/* Member card */
.member-card {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 16px;
}

.member-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.member-number {
    width: 28px;
    height: 28px;
    background: #4361ee;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 600;
}

.btn-remove-member {
    width: 30px;
    height: 30px;
    border-radius: 6px;
    border: 1px solid #dee2e6;
    background: white;
    color: #666;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}
.btn-remove-member:hover { background: #dc3545; color: white; border-color: #dc3545; }

.member-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.member-fields .full-width { grid-column: span 2; }

/* File upload */
.file-upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 16px;
    text-align: center;
    cursor: pointer;
    background: white;
    transition: all 0.2s;
    position: relative;
    overflow: hidden;
}
.file-upload-area:hover { border-color: #4361ee; background: #f0f7ff; }

.file-input {
    position: absolute;
    width: 100%; height: 100%;
    top: 0; left: 0;
    opacity: 0; cursor: pointer;
}

.upload-placeholder {
    pointer-events: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}
.upload-placeholder i { font-size: 20px; color: #adb5bd; }
.upload-placeholder span { font-size: 13px; color: #666; }
.upload-placeholder small { font-size: 11px; color: #999; }

.photo-preview {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 10px;
    position: relative;
}

.preview-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.btn-remove-photo {
    width: 24px; height: 24px;
    border-radius: 50%;
    border: 1px solid #dee2e6;
    background: white;
    color: #666;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    transition: all 0.2s;
}
.btn-remove-photo:hover { background: #dc3545; color: white; border-color: #dc3545; }

.btn-add-member {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    background: #10b981;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s;
    margin-top: 4px;
}
.btn-add-member:hover { background: #0da271; }

.form-actions {
    display: flex;
    gap: 12px;
    padding-top: 4px;
}

.btn-submit {
    flex: 1;
    padding: 13px 24px;
    background: #4361ee;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.2s;
}
.btn-submit:hover { background: #3651d4; }

.btn-cancel {
    padding: 13px 24px;
    background: white;
    color: #666;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}
.btn-cancel:hover { background: #f8f9fa; color: #333; }

@media (max-width: 640px) {
    .org-form-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    .member-fields { grid-template-columns: 1fr; }
    .member-fields .full-width { grid-column: span 1; }
    .form-actions { flex-direction: column; }
    .form-card { padding: 16px; }
}
</style>