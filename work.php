<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== FAVICON ===============-->
      <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="assets/css/style1.css">

      <title>Fares KOUIDER-DJELLOUL</title>
   </head>
   <body>
      <!--==================== HEADER ====================-->
      <header class="header header-pages" id="header">
         <nav class="nav container">
            <a href="index.html" class="nav__logo">Fares KDJ</a>

            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">
                  <li class="nav__item">
                     <a href="index.html" class="nav__link">Home</a>
                  </li>

                  <li class="nav__item">
                     <a href="about.html" class="nav__link">About Me</a>
                  </li>

                  <li class="nav__item">
                     <a href="work.html" class="nav__link">Portfolio</a>
                  </li>

                  <li class="nav__item">
                     <a href="contact.html" class="button">Contact Me</a>
                  </li>
               </ul>


               <!-- close button -->
               <div class="nav__close" id="nav-close">
                  <i class="ri-close-line"></i>
               </div>
            </div> 
               <div class="nav__actions">
                  <!-- Theme button -->
                  <i class="ri-moon-line change-theme" id="theme-button"></i>
                  <!-- Toggle button  -->
                  <div class="nav__toggle" id="nav-toggle">
                     <i class="ri-apps-2-line"></i>
                  </div>
               </div>
         </nav>
      </header>

      <!--==================== MAIN ====================-->
      <main class="main">
<!--==================== WORK ====================-->
<section class="tm-portfolio">
    <h2 class="section__title">
        My Most <br>
        Recent Works 
    </h2>

    <!-- Filter Buttons -->
    <div class="filter-wrapper">
        <ul>
            <li><a href="javascript:void(0);" class="selected" data-filter="*">All</a></li>
            <li><a href="javascript:void(0);" data-filter=".design">Design</a></li>
            <li><a href="javascript:void(0);" data-filter=".web_development">Web Development</a></li>
            <li><a href="javascript:void(0);" data-filter=".filmmaking">Filmmaking</a></li>
            <li><a href="javascript:void(0);" data-filter=".video_editing">Video Editing</a></li>
        </ul>
    </div>

    <div class="iso-box-section">
        <div class="iso-box-wrapper grid">
            <?php
            // Include the database connection
            include './portfolio/includes/db.php';

            // Fetch projects and their associated files from the database
            $sql = "
                SELECT p.id, p.title, p.description, p.category, pf.file_path, pf.file_type 
                FROM projects p 
                LEFT JOIN project_files pf ON p.id = pf.project_id
                ORDER BY p.id DESC
            ";
            $stmt = $conn->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Group files by project
            $projects = [];
            foreach ($results as $row) {
                $project_id = $row['id'];
                if (!isset($projects[$project_id])) {
                    $projects[$project_id] = [
                        'title' => $row['title'],
                        'description' => $row['description'],
                        'category' => $row['category'],
                        'files' => []
                    ];
                }
                if ($row['file_path']) {
                    $projects[$project_id]['files'][] = [
                        'file_path' => './portfolio/uploads/' . basename($row['file_path']),
                        'file_type' => $row['file_type']
                    ];
                }
            }

            if (!empty($projects)) {
                foreach ($projects as $project_id => $project):
                    $first_file = !empty($project['files']) ? $project['files'][0] : null;
            ?>
                    <div class="iso-box <?php echo htmlspecialchars($project['category']); ?>">
                        <?php if ($first_file): ?>
                            <a href="javascript:void(0);" class="work__link" data-project-id="<?php echo $project_id; ?>" onclick="openModal(<?php echo $project_id; ?>)">
                                <?php if (strpos($first_file['file_type'], 'image/') === 0): ?>
                                    <img src="<?php echo $first_file['file_path']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="work__img">
                                <?php elseif (strpos($first_file['file_type'], 'video/') === 0): ?>
                                    <img src="assets/img/video-placeholder.png" alt="<?php echo htmlspecialchars($project['title']); ?>" class="work__img">
                                <?php endif; ?>
                                <i class="ri-arrow-right-circle-line work__icon"></i>
                            </a>
                        <?php endif; ?>
                        <h2 class="work__title"><?php echo htmlspecialchars($project['title']); ?></h2>
                        <span class="work__subtitle"><?php echo htmlspecialchars($project['category']); ?></span>
                    </div>
                <?php endforeach; ?>
            <?php } else { ?>
                <p>No projects to display.</p>
            <?php } ?>
        </div>
    </div>

    <!-- Modal for carousel and description -->
    <div id="projectModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">×</span>
            <h2 id="modalTitle"></h2>
            <div class="swiper">
                <div class="swiper-wrapper" id="modalSlides"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <p id="modalDescription"></p>
        </div>
    </div>

    <!-- Swiper.js and Isotope.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Other scripts -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/index.js"></script>

    <script>
        // Initialize Isotope
        $(document).ready(function() {
            $('.iso-box-wrapper').isotope({
                itemSelector: '.iso-box',
                layoutMode: 'fitRows'
            });

            // Filter items on button click
            $('.filter-wrapper a').click(function() {
                var filterValue = $(this).attr('data-filter');
                $('.iso-box-wrapper').isotope({ filter: filterValue });
                $('.filter-wrapper a').removeClass('selected');
                $(this).addClass('selected');
                return false;
            });
        });

        // Store projects data for JavaScript access
        const projects = <?php echo json_encode($projects); ?>;
        let swiperInstance = null;

        function openModal(projectId) {
            const project = projects[projectId];
            if (!project) return;

            // Set modal title and description
            document.getElementById('modalTitle').textContent = project.title;
            document.getElementById('modalDescription').textContent = project.description;

            // Clear previous slides
            const slidesContainer = document.getElementById('modalSlides');
            slidesContainer.innerHTML = '';

            // Add slides for each file
            project.files.forEach(file => {
                const slide = document.createElement('div');
                slide.className = 'swiper-slide';
                if (file.file_type.startsWith('image/')) {
                    slide.innerHTML = `<img src="${file.file_path}" alt="${project.title}" style="max-width: 100%; height: auto;">`;
                } else if (file.file_type.startsWith('video/')) {
                    slide.innerHTML = `<video controls style="max-width: 100%; height: auto;">
                        <source src="${file.file_path}" type="${file.file_type}">
                        Your browser does not support the video tag.
                    </video>`;
                }
                slidesContainer.appendChild(slide);
            });

            // Destroy previous Swiper instance if it exists
            if (swiperInstance && typeof swiperInstance.destroy === 'function') {
                swiperInstance.destroy(true, true);
                swiperInstance = null;
            }

            // Initialize Swiper
            swiperInstance = new Swiper('.swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: project.files.length > 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            // Show modal
            document.getElementById('projectModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('projectModal').style.display = 'none';
            // Destroy Swiper instance on close to prevent memory leaks
            if (swiperInstance && typeof swiperInstance.destroy === 'function') {
                swiperInstance.destroy(true, true);
                swiperInstance = null;
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('projectModal');
            if (event.target === modal) {
                closeModal();
            }
        };
    </script>
</section>
      </main>

      <!--==================== FOOTER ====================-->
      <footer class="footer">
         <div class="footer__container container grid">
            <div class="footer__content grid">
               <a href="index.html" class="footer__logo">Fares KDJ</a>

               <ul class="footer__links">
                  <li>
                     <a href="about.html" class="footer__link">About Me</a>
                  </li>

                  <li>
                     <a href="work.html" class="footer__link">Portfolio</a>
                  </li>

                  <li>
                     <a href="contact.html" class="footer__link">Contact Me</a>
                  </li>
               </ul>

               <div class="footer__social">
                  <a href="https://www.facebook.com/viscaa.barca.37?locale=fr_FR" target="_blank" class="footer__social-link">
                     <i class="ri-facebook-circle-fill"></i>
                  </a>

                  <a href="https://www.instagram.com/fares.kdj/" target="_blank" class="footer__social-link">
                     <i class="ri-instagram-fill"></i>
                  </a>

                  <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                     <i class="ri-twitter-x-fill"></i>
                  </a>

                  <a href="https://www.linkedin.com/in/fares-kouider-djelloul-173305260?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank" class="footer__social-link">
                     <i class="ri-linkedin-box-fill"></i>
                  </a>
               </div>
            </div>

            <span class="footer__copy">
               &#169; All Rights Reserved By Fares.KDJ
            </span>
         </div>
      </footer>

      <!--=============== MAIN JS ===============-->
      <script src="assets/js/main.js"></script>
   </body>
</html>