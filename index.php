<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== FAVICON ===============-->
      <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

      <!--=============== SWIPER CSS ===============-->
      <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="./assets/css/style1.css">
         <!-- Swiper.js CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

      <title>Fares KOUIDER-DJELLOUL</title>
   </head>
   <body>
      <!--==================== HEADER ====================-->
      <header class="header" id="header">
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
         <!--==================== HOME ====================-->
         <section class="home section">
            <div class="home__rectangle"></div>

            <div class="home__container container grid">
               <div class="home__perfil perfil">
                  <div class="perfil__content">
                     <img src="./assets/img/test.png" alt="image" class="perfil__img">
                  </div>

               </div>

               <div class="home__content grid">
                     <div class="home__data grid">
                        <h1 class="home__name">Fares KOUIDER-DJELLOUL</h1>
                        <h2 class="home__profession">Computer networks & Telecommunications Engineer</h2>

                        <div class="home__social">
                           <a href="https://github.com/" target="_blank" class="home__social-link">
                              <i class="ri-github-line"></i>
                           </a>

                           <a href="https://www.linkedin.com/in/fares-kouider-djelloul-173305260?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"  target="_blank" class="home__social-link">
                              <i class="ri-linkedin-box-fill"></i>
                           </a>

                           <a href="https://dribbble.com/" target="_blank" class="home__social-link">
                              <i class="ri-dribbble-line"></i>
                           </a>
                        </div>
                     </div>
                     <a href="./assets/pdf/Fares-Cv.pdf" target="_blank" download="" class="home__button button">Download CV</a>
               </div>

               
            </div>
         </section>

         <!--==================== SERVICES ====================-->
         <section class="services section">
            <h2 class="section__title">
               The Services <br> 
               I Offer
            </h2>

            <div class="services__container container grid">
               <article class="services__card">
                  <i class="ri-code-s-slash-line services__icon"></i>
                  <h2 class="services__title">Web Developer</h2>
                  <p class="services__description">
                     Beautiful and elegant designs with 
                     interfaces that are intuitive, efficient and 
                     pleasant to use for the user.
                  </p>

                  <button class="services__button button">Know More</button>

                  <div class="services__modal">
                     <div class="services__modal-content">
                        <i class="ri-close-line services__modal-close"></i>

                        <h2 class="services__modal-title">Web Developer</h2>

                        <ul class="services__modal-list grid">
                           <li class="services__modal-item">
                           Create professional and high-quality websites tailored to client specifications.
                           </li>
                              
                           <li class="services__modal-item">
                              I do web design in prototypes.
                           </li>

                           <li class="services__modal-item">
                              I optimize website performance for improved user experience.
                           </li>

                           <li class="services__modal-item">
                              I troubleshoot and resolve performance issues on web pages.
                           </li>
                        </ul>
                     </div>
                  </div>
               </article>

               <article class="services__card">
                  <i class="ri-pen-nib-line services__icon"></i>
                  <h2 class="services__title">graphic design</h2>
                  <p class="services__description">
                     Elevate your brand with our creative design solutions.
                      we'll help you make a lasting impression with 
                      our unique and professional designs.
                  </p>

                  <button class="services__button button">Know More</button>

                  <div class="services__modal">
                     <div class="services__modal-content">
                        <i class="ri-close-line services__modal-close"></i>

                        <h2 class="services__modal-title">graphic design</h2>

                        <ul class="services__modal-list grid">
                           <li class="services__modal-item">
                              Crafting memorable and impactful logos that embody your brand's essence.
                           </li>
                              
                           <li class="services__modal-item">
                              Developing cohesive visual identities, including color palettes, typography, and brand guidelines.
                           </li>

                           <li class="services__modal-item">
                              Designing engaging digital assets for websites, social media, and online advertising.
                           </li>

                           <li class="services__modal-item">
                              Providing custom illustrations to complement your brand or convey complex ideas.
                           </li>
                        </ul>
                     </div>
                  </div>
               </article>

               <article class="services__card">
                  <i class="ri-base-station-line services__icon"></i>
                  <h2 class="services__title"> Telco Cloud and NetDevOps</h2>
                  <p class="services__description">
                  Specializing in Telco Cloud and NetDevOps to ensure seamless, automated,
                  and secure network operations for modern telecom infrastructures.
                  </p>

                  <button class="services__button button">Know More</button>

                  <div class="services__modal">
                     <div class="services__modal-content">
                        <i class="ri-close-line services__modal-close"></i>

                        <h2 class="services__modal-title">Telco Cloud and NetDevOps</h2>

                        <ul class="services__modal-list grid">
                           <li class="services__modal-item">
                              Create and implement scalable, secure, and high-performance 5G network infrastructures tailored to telecom operators' needs.
                           </li>
                              
                           <li class="services__modal-item">
                              Develop and integrate CI/CD pipelines for seamless deployment and updates of telecom network functions.
                           </li>

                           <li class="services__modal-item">
                              Customize 5G Core components, such as UPF, to meet specific use cases like IoT, smart cities, and connected vehicles.

                           <li class="services__modal-item">
                              Perform regular audits and simulate network stress scenarios to identify vulnerabilities and recommend optimizations.
                           </li>
                        </ul>
                     </div>
                  </div>
               </article>
            </div>
         </section>

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
         <!--==================== TESTIMONIAL ====================-->
         <section class="testimonial section">
            <h2 class="section__title">
               What They Say <br> 
               About Me? 
            </h2>

            <div class="testimonial__container container">
               <div class="testimonial__swiper swiper">
                  <div class="swiper-wrapper">
                     <article class="testimonial__card swiper-slide">
                        <div class="testimonial__border">
                           <img src="assets/img/testimonial-1.png" alt="image" class="testimonial__img">
                        </div>

                        <h2 class="testimonial__name">Fouad BOUKLI HACENE</h2>
                        <p class="testimonial__description">
                           This dedicated engineering student shines bright with his steadfast dedication to his community,
                            showcasing a profound sense of collective responsibility.
                             Eager to utilize his skills for the betterment of others,
                              he exemplifies a genuine regard for diversity, inclusion, and fairness,
                                while consistently demonstrating empathy and compassion towards everyone he encounters
                        </p>
                     </article>

                     <article class="testimonial__card swiper-slide">
                        <div class="testimonial__border">
                           <img src="assets/img/testimonial-2.png" alt="image" class="testimonial__img">
                        </div>

                        <h2 class="testimonial__name">Manel HAMIANI</h2>
                        <p class="testimonial__description">
                           This engineering student, specializing in computer networks, 
                           stands out for his dedication to utilizing his skills for the benefit of others.
                            He shows a strong commitment to community engagement, demonstrating a deep respect for diversity and inclusivity. 
                            His empathy and compassion towards everyone around him are truly admirable.
                        </p>
                     </article>

                     <article class="testimonial__card swiper-slide">
                        <div class="testimonial__border">
                           <img src="assets/img/testimonial-3.png" alt="image" class="testimonial__img">
                        </div>

                        <h2 class="testimonial__name">Mohammed Amin CHARCHAL </h2>
                        <p class="testimonial__description">
                           I have worked with Fares for 4 years within the framework of the pic club that we manage.
                           I can summarize my experience with him as excellent in all aspects,
                            as he is suitable for all tasks at all times and under any circumstances.
                        </p>
                     </article>

                     <article class="testimonial__card swiper-slide">
                        <div class="testimonial__border">
                           <img src="assets/img/testimonial-4.png" alt="image" class="testimonial__img">
                        </div>

                        <h2 class="testimonial__name">Abdelhak BENDJEBARA</h2>
                        <p class="testimonial__description">
                           I've known Fares for 3 years , and his expertise in computer networks and telecommunications is impressive.
                            He's a problem-solving expert with exceptional technical skills, a great communicator, and a motivating leader.
                             His dedication to excellence and positive attitude make him a valuable asset to any team.
                        </p>
                     </article>
                  </div>
               </div>

                <!-- Pagination -->
               <div class="swiper-pagination"></div>
            </div>
         </section>

         <!--==================== CONTACT ====================-->
         <section class="contact section">
            <div class="contact__container container grid">
               <h2 class="section__title">
                  Let's Talk <br>
                  About Your Project 
               </h2>

               <a href="contact.html" class="contact__button button">Contact Me</a>
            </div>
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

      <!--========== SCROLL UP ==========-->
         <a href="#" class="scrollup" id="scroll-up">
            <i class="ri-arrow-up-line"></i>
         </a>

      <!--=============== MAIN JS ===============-->
      <script src="assets/js/main.js"></script>

      <!--=============== SWIPER JS ===============-->
      <script src="assets/js/swiper-bundle.min.js"></script>

      <!--=============== INDEX JS ===============-->
      <script src="assets/js/index.js"></script>

    
   </body>
</html>