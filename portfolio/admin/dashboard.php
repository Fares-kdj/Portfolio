
<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/db.php';
$sql = "SELECT * FROM projects";
$stmt = $conn->query($sql);
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convert projects to JSON for JavaScript
$projectsData = json_encode($projects);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="./styl.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="app-icon">
                    <div class="logo-image"></div>
                </div>
                <button class="mode-switch" title="تبديل الوضع">
                    <i class="fas fa-sun"></i>
                </button>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item active" data-view="products">
                    <a href="dashboard.php">
                        <i class="fas fa-home"></i>
                        <span>لوحة التحكم</span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="#" class="open-add-project-modal">
                        <i class="fas fa-plus"></i>
                        <span>إضافة مشروع</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Delete Confirmation Modal -->
<div class="modal" id="deleteProjectModal">
    <div class="modal-content">
        <h2>تأكيد الحذف</h2>
        <p>هل أنت متأكد من حذف هذا المشروع؟ لا يمكن التراجع عن هذا الإجراء.</p>
        <div class="button-container">
            <button id="confirmDeleteButton">تأكيد</button>
            <button id="cancelDeleteButton">إلغاء</button>
        </div>
    </div>
</div>

        <!-- Mobile Menu -->
        <button class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="mobile-menu" id="mobileMenu">
            <button class="close-menu">×</button>
            <div class="mobile-brand">
                <div class="app-icon">
                    <div class="logo-image"></div>
                </div>
            </div>
            <ul class="mobile-nav-links">
                <!-- Populated by JavaScript -->
            </ul>
        </div>
        <div class="mobile-menu-overlay"></div>

        <!-- Main Content -->
        <div class="app-content">
            <div class="app-content-header">
                <h1 class="app-content-headerText" id="header-text">المشاريع</h1>
                <div>
                    <button class="action-button list active">قائمة</button>
                    <button class="action-button grid">شبكة</button>
                    
                </div>
            </div>
            <div class="app-content-actions">
                <input class="search-bar" placeholder="بحث..." type="text">
                <div class="app-content-actions-wrapper">
                    <div class="filter-button-wrapper">
                        <button class="action-button jsFilter">تصفية</button>
                        <div class="filter-menu">
                            <label>الفئة</label>
                            <select id="filter-category">
                                <option value="All Categories">كل الفئات</option>
                                <?php
                                $categories = array_unique(array_column($projects, 'category'));
                                foreach ($categories as $category):
                                ?>
                                    <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="filter-menu-buttons">
                                <button class="filter-button reset">إعادة تعيين</button>
                                <button class="filter-button apply">تطبيق</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="products-area-wrapper tableView" id="content-area">
                <div class="products-header">
                    <div class="product-cell title">العنوان</div>
                    <div class="product-cell description">الوصف</div>
                    <div class="product-cell category">الفئة</div>
                    <div class="product-cell actions">الإجراءات</div>
                </div>
                <?php if (empty($projects)): ?>
                    <div class="products-row">
                        <div class="product-cell error-message" style="grid-column: span 4;">
                            لا توجد مشاريع
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($projects as $project): ?>
                        <div class="products-row">
                            <div class="product-cell title"><?php echo htmlspecialchars($project['title']); ?></div>
                            <div class="product-cell description"><?php echo htmlspecialchars($project['description']); ?></div>
                            <div class="product-cell category"><?php echo htmlspecialchars($project['category']); ?></div>
                            <div class="product-cell actions">
                                <div class="product-actions">
                                    <a href="#" class="edit-link" data-id="<?php echo $project['id']; ?>">تعديل</a>
                                    <a href="#" class="delete-link" data-id="<?php echo $project['id']; ?>">حذف</a>
                                </div>
                            </div>
                            <div class="product-info-grid">
                                <div class="image-container">
                                    <img class="product-image-grid" src="<?php echo htmlspecialchars($project['image_urls'] ?? 'https://via.placeholder.com/150'); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                                </div>
                                <div class="product-details">
                                    <div class="product-title"><?php echo htmlspecialchars($project['title']); ?></div>
                                    <div class="product-detail"><span>الوصف:</span> <?php echo htmlspecialchars($project['description']); ?></div>
                                    <div class="product-detail"><span>الفئة:</span> <?php echo htmlspecialchars($project['category']); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Edit Project Modal -->
        <div class="modal" id="editProductModal">
            <div class="modal-content">
                <h2>تعديل المشروع</h2>
                <form id="editProductForm">
                    <input type="hidden" name="product_id" id="editProductId">
                    <div class="form-group">
                        <label for="editTitle">العنوان</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">الوصف</label>
                        <textarea class="form-control" id="editDescription" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editCategory">الفئة</label>
                        <select class="form-control" id="editCategory" name="category" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="button-container">
                        <button type="submit">حفظ</button>
                        <button type="button" onclick="closeEditProductModal()">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Project Modal -->
        <div class="modal" id="addProductModal">
            <div class="modal-content">
                <h2>إضافة مشروع</h2>
                <form id="addProductForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="addTitle">العنوان</label>
                        <input type="text" class="form-control" id="addTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="addDescription">الوصف</label>
                        <textarea class="form-control" id="addDescription" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="addCategory">الفئة</label>
                        <select class="form-control" id="addCategory" name="category" required>
                            <option value="design">تصميم</option>
                            <option value="web_development">تطوير ويب</option>
                            <option value="adsmanager">ادارة اعلانات</option>
                            <option value="networking">شبكات</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="addFiles">الملفات (حتى 10 صور أو فيديو واحد)</label>
                        <input type="file" class="form-control" id="addFiles" name="files[]" accept="image/*,video/*" multiple required>
                    </div>
                    <div class="button-container">
                        <button type="submit">إضافة</button>
                        <button type="button" onclick="closeAddProductModal()">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Pass PHP projects data to JavaScript
        const projectsData = <?php echo $projectsData; ?>;

        // Notification Function
        function showNotification(message, isSuccess) {
            document.querySelectorAll('.success-notification, .error-notification').forEach(notification => {
                notification.remove();
            });
            const notification = document.createElement('div');
            notification.className = isSuccess ? 'success-notification' : 'error-notification';
            notification.textContent = isSuccess ? message : `خطأ: ${message}`;
            document.querySelector('.app-content').prepend(notification);
            setTimeout(() => notification.remove(), 5000);
        }

        // Dark/Light Mode Toggle
        const modeSwitch = document.querySelector('.mode-switch');
        if (modeSwitch) {
            modeSwitch.addEventListener('click', () => {
                document.documentElement.classList.toggle('light');
                modeSwitch.classList.toggle('active');
                console.log('تم تبديل الوضع الداكن/الفاتح');
            });
        } else {
            console.error('العنصر .mode-switch غير موجود');
        }

        // Mobile Menu Functionality
        document.addEventListener('DOMContentLoaded', function () {
            const hamburger = document.querySelector('.hamburger');
            const mobileMenu = document.getElementById('mobileMenu');
            const closeMenu = document.querySelector('.close-menu');
            const mobileNavLinks = document.querySelector('.mobile-nav-links');
            const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');

            // Copy sidebar items to mobile menu
            const sidebarItems = document.querySelectorAll('.sidebar-list-item');
            mobileNavLinks.innerHTML = '';
            sidebarItems.forEach(item => {
                const mobileItem = document.createElement('li');
                mobileItem.setAttribute('data-view', item.getAttribute('data-view'));
                if (item.classList.contains('active')) {
                    mobileItem.classList.add('active');
                }
                const link = document.createElement('a');
                link.href = item.querySelector('a').href;
                link.innerHTML = item.querySelector('a').innerHTML;
                if (item.querySelector('.open-add-project-modal')) {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        openAddProductModal();
                    });
                }
                mobileItem.appendChild(link);
                mobileNavLinks.appendChild(mobileItem);
            });

            // Open/close mobile menu
            hamburger.addEventListener('click', function () {
                mobileMenu.classList.toggle('open');
                hamburger.classList.toggle('active');
                mobileMenuOverlay.classList.toggle('active');
            });

            closeMenu.addEventListener('click', function () {
                mobileMenu.classList.remove('open');
                hamburger.classList.remove('active');
                mobileMenuOverlay.classList.remove('active');
            });

            mobileMenuOverlay.addEventListener('click', function () {
                mobileMenu.classList.remove('open');
                hamburger.classList.remove('active');
                this.classList.remove('active');
            });
        });

        // Table/Grid View Toggle
        const viewButtons = document.querySelectorAll('.action-button.list, .action-button.grid');
        const productsWrapper = document.querySelector('.products-area-wrapper');
        if (viewButtons && productsWrapper) {
            viewButtons.forEach(button => {
                button.addEventListener('click', () => {
                    viewButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    productsWrapper.classList.remove('tableView', 'gridView');
                    productsWrapper.classList.add(button.classList.contains('list') ? 'tableView' : 'gridView');
                    console.log('تم تغيير العرض إلى:', button.classList.contains('list') ? 'tableView' : 'gridView');
                });
            });
        } else {
            console.error('العناصر .action-button أو .products-area-wrapper غير موجودة');
        }

        // Filter and Search Management
        const filterButton = document.querySelector('.jsFilter');
        const filterMenu = document.querySelector('.filter-menu');
        const filterCategory = document.querySelector('#filter-category');
        const applyButton = document.querySelector('.filter-button.apply');
        const resetButton = document.querySelector('.filter-button.reset');
        const searchBar = document.querySelector('.search-bar');

        if (filterButton && filterMenu && filterCategory && applyButton && resetButton && searchBar && productsWrapper) {
            let currentCategory = 'All Categories';

            filterButton.addEventListener('click', () => {
                filterMenu.classList.toggle('active');
                console.log('تم تبديل قائمة التصفية');
            });

            document.addEventListener('click', (e) => {
                if (!filterButton.contains(e.target) && !filterMenu.contains(e.target)) {
                    filterMenu.classList.remove('active');
                    console.log('تم إغلاق قائمة التصفية');
                }
            });

            function applyFilters(selectedCategory, searchText) {
                const rows = document.querySelectorAll('.products-row');
                if (rows.length === 0) {
                    console.warn('لم يتم العثور على صفوف المشاريع للتصفية');
                    return;
                }

                searchText = searchText.toLowerCase().trim();

                rows.forEach(row => {
                    const category = row.querySelector('.product-cell.category')?.textContent || 
                                    row.querySelector('.product-detail span')?.nextSibling.textContent.trim() || '';
                    const title = row.querySelector('.product-cell.title')?.textContent.toLowerCase() || 
                                  row.querySelector('.product-title')?.textContent.toLowerCase() || '';

                    const matchesCategory = selectedCategory === 'All Categories' || category === selectedCategory;
                    const matchesSearch = searchText === '' || 
                                         title.includes(searchText) || 
                                         category.toLowerCase().includes(searchText);

                    row.style.display = matchesCategory && matchesSearch ? '' : 'none';
                });

                console.log('تم تطبيق التصفية - الفئة:', selectedCategory, 'البحث:', searchText);
            }

            applyButton.addEventListener('click', () => {
                currentCategory = filterCategory.value;
                applyFilters(currentCategory, searchBar.value);
                filterMenu.classList.remove('active');
            });

            resetButton.addEventListener('click', () => {
                filterCategory.value = 'All Categories';
                currentCategory = 'All Categories';
                searchBar.value = '';
                applyFilters(currentCategory, '');
                filterMenu.classList.remove('active');
                console.log('تم إعادة تعيين التصفية');
            });

            searchBar.addEventListener('input', (e) => {
                const searchText = e.target.value;
                applyFilters(currentCategory, searchText);
                console.log('تم البحث بالكلمة:', searchText);
            });
        } else {
            console.error('العناصر .jsFilter, .filter-menu, #filter-category, .filter-button.apply, .filter-button.reset, .search-bar, أو .products-area-wrapper غير موجودة');
        }

        // Event Listeners
        function attachEventListeners() {
            document.querySelectorAll('.edit-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const projectId = link.getAttribute('data-id');
                    openEditProductModal(projectId);
                });
            });

            document.querySelectorAll('.open-add-project-modal').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    openAddProductModal();
                });
            });

            document.querySelectorAll('.delete-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const projectId = link.getAttribute('data-id');
                    deleteProject(projectId);
                });
            });
        }

        // Edit Project Modal
        function openEditProductModal(projectId) {
            const project = projectsData.find(p => p.id == projectId);
            if (project) {
                document.getElementById('editProductId').value = project.id;
                document.getElementById('editTitle').value = project.title;
                document.getElementById('editDescription').value = project.description;
                document.getElementById('editCategory').value = project.category;
                document.getElementById('editProductModal').style.display = 'flex';
            }
        }

        function closeEditProductModal() {
            document.getElementById('editProductModal').style.display = 'none';
            document.getElementById('editProductForm').reset();
        }

        // Add Project Modal
        function openAddProductModal() {
            document.getElementById('addProductModal').style.display = 'flex';
        }

        function closeAddProductModal() {
            document.getElementById('addProductModal').style.display = 'none';
            document.getElementById('addProductForm').reset();
        }

// Delete Project Modal
function openDeleteProjectModal(projectId) {
    const modal = document.getElementById('deleteProjectModal');
    const confirmButton = document.getElementById('confirmDeleteButton');
    const cancelButton = document.getElementById('cancelDeleteButton');

    modal.style.display = 'flex';

    // Gérer le bouton de confirmation
    confirmButton.onclick = function() {
        fetch(`delete_project.php?id=${projectId}`, {
            method: 'GET'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`خطأ HTTP: ${response.status} ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotification('تم حذف المشروع بنجاح', true);
                const index = projectsData.findIndex(p => p.id == projectId);
                if (index !== -1) {
                    projectsData.splice(index, 1);
                }
                const contentArea = document.getElementById('content-area');
                contentArea.innerHTML = generateProductsHTML(projectsData, 'products');
                applyFilters(filterCategory.value, searchBar.value);
                attachEventListeners();
            } else {
                throw new Error(data.message || 'فشل حذف المشروع');
            }
            modal.style.display = 'none';
        })
        .catch(error => {
            console.error('خطأ في حذف المشروع:', error);
            showNotification(error.message || 'فشل حذف المشروع', false);
            modal.style.display = 'none';
        });
    };

    // Gérer le bouton d'annulation
    cancelButton.onclick = function() {
        modal.style.display = 'none';
    };
}
// Mettre à jour les écouteurs d'événements pour les liens de suppression
function attachEventListeners() {
    document.querySelectorAll('.edit-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const projectId = link.getAttribute('data-id');
            openEditProductModal(projectId);
        });
    });

    document.querySelectorAll('.open-add-project-modal').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            openAddProductModal();
        });
    });

    document.querySelectorAll('.delete-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const projectId = link.getAttribute('data-id');
            openDeleteProjectModal(projectId);
        });
    });
}

        // Edit Form Submission
        document.getElementById('editProductForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('edit_project.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`خطأ HTTP: ${response.status} ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification('تم تحديث المشروع بنجاح', true);
                    closeEditProductModal();
                    const updatedProject = {
                        id: parseInt(formData.get('product_id')),
                        title: formData.get('title'),
                        description: formData.get('description'),
                        category: formData.get('category')
                    };
                    const index = projectsData.findIndex(p => p.id === updatedProject.id);
                    if (index !== -1) {
                        projectsData[index] = { ...projectsData[index], ...updatedProject };
                    }
                    const contentArea = document.getElementById('content-area');
                    contentArea.innerHTML = generateProductsHTML(projectsData, 'products');
                    applyFilters(filterCategory.value, searchBar.value);
                    attachEventListeners();
                } else {
                    throw new Error(data.message || 'فشل تحديث المشروع');
                }
            })
            .catch(error => {
                console.error('خطأ في تحديث المشروع:', error);
                showNotification(error.message || 'فشل تحديث المشروع', false);
            });
        });

        // Add Form Submission
        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('add_project.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`خطأ HTTP: ${response.status} ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification('تم إضافة المشروع بنجاح', true);
                    closeAddProductModal();
                    const newProject = {
                        id: data.project_id,
                        title: formData.get('title'),
                        description: formData.get('description'),
                        category: formData.get('category'),
                        image_urls: data.image_urls || 'https://via.placeholder.com/150'
                    };
                    projectsData.push(newProject);
                    const contentArea = document.getElementById('content-area');
                    contentArea.innerHTML = generateProductsHTML(projectsData, 'products');
                    applyFilters(filterCategory.value, searchBar.value);
                    attachEventListeners();
                } else {
                    throw new Error(data.message || 'فشل إضافة المشروع');
                }
            })
            .catch(error => {
                console.error('خطأ في إضافة المشروع:', error);
                showNotification(error.message || 'فشل إضافة المشروع', false);
            });
        });

        // Generate Products HTML
        function generateProductsHTML(data, view) {
            if (!data || data.length === 0) {
                return `
                    <div class="products-header">
                        <div class="product-cell title">العنوان</div>
                        <div class="product-cell description">الوصف</div>
                        <div class="product-cell category">الفئة</div>
                        <div class="product-cell actions">الإجراءات</div>
                    </div>
                    <div class="products-row">
                        <div class="product-cell error-message" style="grid-column: span 4;">
                            لا توجد مشاريع
                        </div>
                    </div>
                `;
            }

            return `
                <div class="products-header">
                    <div class="product-cell title">العنوان</div>
                    <div class="product-cell description">الوصف</div>
                    <div class="product-cell category">الفئة</div>
                    <div class="product-cell actions">الإجراءات</div>
                </div>
                ${data.map(project => `
                    <div class="products-row">
                        <div class="product-cell title">${project.title}</div>
                        <div class="product-cell description">${project.description}</div>
                        <div class="product-cell category">${project.category}</div>
                        <div class="product-cell actions">
                            <div class="product-actions">
                                <a href="#" class="edit-link" data-id="${project.id}">تعديل</a>
                                <a href="#" class="delete-link" data-id="${project.id}">حذف</a>
                            </div>
                        </div>
                        <div class="product-info-grid">
                            <div class="image-container">
                                <img class="product-image-grid" src="${project.image_urls || 'https://via.placeholder.com/150'}" alt="${project.title}">
                            </div>
                            <div class="product-details">
                                <div class="product-title">${project.title}</div>
                                <div class="product-detail"><span>الوصف:</span> ${project.description}</div>
                                <div class="product-detail"><span>الفئة:</span> ${project.category}</div>
                            </div>
                        </div>
                    </div>
                `).join('')}
            `;
        }

        // Initialize event listeners
        attachEventListeners();
    </script>
</body>
</html>
