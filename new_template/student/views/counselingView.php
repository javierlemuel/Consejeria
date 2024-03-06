<?php
if (!isset($_SESSION['student_authenticated']) && $_SESSION['student_authenticated'] !== true) {
    header("Location: ./index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Consejeria UPRA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <link defer rel="stylesheet" type="text/css" media="screen" href="assets/css/animate.css" />
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script defer src="assets/js/popper.min.js"></script>
    <script defer src="assets/js/tippy-bundle.umd.min.js"></script>
    <script defer src="assets/js/sweetalert.min.js"></script>
</head>

<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]">
    <!-- sidebar menu overlay -->
    <div x-cloak class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>

    <!-- screen loader -->
    <!-- <div class="screen_loader animate__animated fixed inset-0 z-[60] grid place-content-center bg-[#fafafa] dark:bg-[#060818]">
        <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
            <path d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s" repeatCount="indefinite" />
            </path>
            <path d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="360 67 67" dur="8s" repeatCount="indefinite" />
            </path>
        </svg>
    </div> -->

    <!-- scroll to top button -->
    <div class="fixed bottom-6 z-50 ltr:right-6 rtl:left-6" x-data="scrollToTop">
        <template x-if="showTopButton">
            <button type="button" class="btn btn-outline-primary animate-pulse rounded-full bg-[#fafafa] p-2 dark:bg-[#060818] dark:hover:bg-primary" @click="goToTop">
                <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M12 20.75C12.4142 20.75 12.75 20.4142 12.75 20L12.75 10.75L11.25 10.75L11.25 20C11.25 20.4142 11.5858 20.75 12 20.75Z" fill="currentColor" />
                    <path d="M6.00002 10.75C5.69667 10.75 5.4232 10.5673 5.30711 10.287C5.19103 10.0068 5.25519 9.68417 5.46969 9.46967L11.4697 3.46967C11.6103 3.32902 11.8011 3.25 12 3.25C12.1989 3.25 12.3897 3.32902 12.5304 3.46967L18.5304 9.46967C18.7449 9.68417 18.809 10.0068 18.6929 10.287C18.5768 10.5673 18.3034 10.75 18 10.75L6.00002 10.75Z" fill="currentColor" />
                </svg>
            </button>
        </template>
    </div>

    <div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">
        <!-- start sidebar section -->
        <?php include('layouts/sidebar.php'); ?>
        <!-- end sidebar section -->

        <div class="main-content flex flex-col min-h-screen">
            <!-- start header section -->
            <?php include('layouts/header.php'); ?>
            <!-- end header section -->

            <div class="animate__animated p-6" :class="[$store.app.animation]">
                <!-- start main content section -->
                <div>
                    <div class="mb-5" x-data="{ active: 1 }">
                        <div class="space-y-2 font-semibold">
                            <div id="intructionSection">
                                <!-- Start Instructions accordion -->
                                <div class="mb-5" x-data="{ active: 1 }">
                                    <div class="space-y-2 font-semibold">
                                        <div class="border border-[#d3d3d3] rounded dark:border-[#1b2e4b]">
                                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 1}" x-on:click="active === 1 ? active = null : active = 1">
                                                Instrucciones
                                            </button>
                                            <div x-cloak x-show="active === 1" x-collapse>
                                                <div class="space-y-2 p-4 text-white-dark text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                                                    <h5 class="m-0">Para realizar la consejeria academica siga los siguientes pasos:</h5>
                                                    <ol class="list-inside list-decimal space-y-3 font-semibold">
                                                        <li>Consulte su expediente</li>
                                                        <li>Verifique su cohorte correspondiente.</li>
                                                        <li>Escoja los cursos que aspira tomar el próximo semestre.</li>
                                                        <li>Revise su lista de cursos seleccionados y confirme su consejería.</li>
                                                    </ol>
                                                    <?php
                                                    //var_dump($selectedCourses);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Instructions accordion -->
                            </div>
                            <!-- start recommended courses table -->
                            <div id="recommendedCoursesSection">
                                <?php
                                //crea array con categoria de cursos
                                $courseCategories = array(
                                    "recomendadas",
                                    "concentracion",
                                    "generales",
                                );
                                //variable to control that only the first tab in the accoridon is open by default
                                $tab = 1;

                                //iterate through categories and create a new tab for the accordion 
                                foreach ($courseCategories as $category) :
                                    $category = strtoupper($category); ?>

                                    <!-- create accordion tabs -->
                                    <div class='border border-[#d3d3d3] dark:border-[#1b2e4b] rounded'>
                                        <button type='button' class='p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]' :class='{"!text-primary" : active === <?= $tab ?>}' x-on:click='active === <?= $tab ?> ? active = null : active =<?= $tab ?>'>
                                            <?= $category ?>
                                        </button>
                                        <div x-cloak x-show='active === <?= $tab ?>' x-collapse>
                                            <div class='p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]'>
                                                <div class='table-responsive'>
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>Seleccionar</th>
                                                                <th>Curso</th>
                                                                <th>Nombre</th>
                                                                <th>Creditos</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- create rows with the course info -->
                                                            <?php if ($category == 'RECOMENDADAS') {
                                                                $courses = array_slice($recommendedCourses, 0);
                                                            } elseif ($category == 'CONCENTRACION') {
                                                                $courses = array_slice($concentrationCourses, 0);
                                                            } elseif ($category == 'GENERALES') {
                                                                $courses = array_slice($generalCourses, 0);
                                                            }

                                                            //var_dump($recommendedCourses);
                                                            //var_dump($courses);
                                                            ?>


                                                            <?php foreach ($courses as $course) : ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php if (substr($course['crse_code'], -1) != 'X') { ?>
                                                                            <input type='checkbox' class='form-checkbox' value=<?php echo $course['crse_code'] ?> />
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td><?= $course['crse_code'] ?></td>
                                                                    <td><?= mb_strtoupper($course['name']) ?></td>
                                                                    <td><?= $course['credits'] ?></td>
                                                                </tr>
                                                            <?php endforeach;  ?>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $tab = $tab + 1; ?>
                                <?php endforeach; ?>
                            </div>


                        </div>
                    </div>
                    <!-- end main content section -->

                </div>

                <!-- start footer section -->
                <div class="p-6 pt-0 mt-auto text-center dark:text-white-dark ltr:sm:text-left rtl:sm:text-right">
                    © <span id="footer-year">2022</span>. UPRA All rights reserved.
                </div>
                <!-- end footer section -->
            </div>
        </div>

        <script src="assets/js/alpine-collaspe.min.js"></script>
        <script src="assets/js/alpine-persist.min.js"></script>
        <script defer src="assets/js/alpine-ui.min.js"></script>
        <script defer src="assets/js/alpine-focus.min.js"></script>
        <script defer src="assets/js/alpine.min.js"></script>
        <script src="assets/js/custom.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


        <script>
            function showinfo() {
                document.getElementById("info").style.display = 'block';
            }

            function hideinfo() {
                document.getElementById("info").style.display = 'none';
            }

            document.addEventListener('alpine:init', () => {
                // main section
                Alpine.data('scrollToTop', () => ({
                    showTopButton: false,
                    init() {
                        window.onscroll = () => {
                            this.scrollFunction();
                        };
                    },

                    scrollFunction() {
                        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                            this.showTopButton = true;
                        } else {
                            this.showTopButton = false;
                        }
                    },

                    goToTop() {
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 0;
                    },
                }));


                // sidebar section
                Alpine.data('sidebar', () => ({
                    init() {
                        const selector = document.querySelector('.sidebar ul a[href="' + window.location.pathname + '"]');
                        if (selector) {
                            selector.classList.add('active');
                            const ul = selector.closest('ul.sub-menu');
                            if (ul) {
                                let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                                if (ele) {
                                    ele = ele[0];
                                    setTimeout(() => {
                                        ele.click();
                                    });
                                }
                            }
                        }
                    },
                }));

                // header section
                Alpine.data('header', () => ({
                    init() {
                        const selector = document.querySelector('ul.horizontal-menu a[href="' + window.location.pathname + '"]');
                        if (selector) {
                            selector.classList.add('active');
                            const ul = selector.closest('ul.sub-menu');
                            if (ul) {
                                let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                                if (ele) {
                                    ele = ele[0];
                                    setTimeout(() => {
                                        ele.classList.add('active');
                                    });
                                }
                            }
                        }
                    },

                    removeMessage(value) {
                        this.messages = this.messages.filter((d) => d.id !== value);
                    },
                }));
            });


            //clear course takes the course to be remove 
            const clearCourse = (course) => {

                //retrieve the list of courses stored in sessionStorage
                let selectedCourses = JSON.parse(sessionStorage.getItem('selectedCourses'))

                //remove the li element that correspong to the course to be removed
                console.log("course to remove: ", course);
                if (typeof course == 'object') {
                    course = course.id;
                }
                $('#' + course).remove();

                //uncheck the checkbox of te removed course
                const index = selectedCourses.indexOf(course);
                let checkbox = $(`input[type="checkbox"][value=${course}]`);
                if (index > -1) {
                    //uncheck el checkbox de la lista
                    checkbox.prop('checked', false);
                    console.log("el checkbox unchecked: ", checkbox);
                    selectedCourses.splice(index, 1);
                }

                //remove the course form the list in the sessionStorage
                selectedCourses = selectedCourses.filter(item => item !== course);
                sessionStorage.setItem('selectedCourses', JSON.stringify(selectedCourses));
            }


            document.addEventListener("alpine:init", () => {
                Alpine.data("collapse", () => ({
                    collapse: false,

                    collapseSidebar() {
                        this.collapse = !this.collapse;
                    },
                }));

                Alpine.data("dropdown", (initialOpenState = false) => ({
                    open: initialOpenState,

                    toggle() {
                        this.open = !this.open;
                    },
                }));
            });

            $(document).ready(() => {
                const generales = ['MATE', 'INGL', 'CIBI', 'ESPA', 'FISI'];

                //retrieve the list of courses in session storage 
                if (sessionStorage.getItem('selectedCourses')) {
                    //copy the course list in the session storage
                    let courseList = JSON.parse(sessionStorage.getItem('selectedCourses'));
                    console.log("courses: ", courseList);

                    if (courseList.length > 0) {
                        //por cada checkbox seleccionado
                        courseList.forEach((selectedCourse) => {
                            //si la clase no existe en el array de clases seleccionadas la anade al array y al sidebar

                            console.log("each selected course: ", selectedCourse);
                            const courseCode = selectedCourse;

                            let category = '';
                            if (courseCode.startsWith("CCOM")) {
                                category = $('#concentracion');
                            } else if (generales.some(substr => courseCode.startsWith(substr))) {
                                category = $('#generales');
                            } else if (courseCode.startsWith("HUMA")) {
                                category = $('#humanidades');
                            } else if (courseCode.startsWith("CISO")) {
                                category = $('#cienciasSociales');
                            }
                            let html = `<li id="${courseCode}">
                            <h3 style="font-size: 12px;" class="justify-between -mx-4 mb-2 flex items-center  py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]" style="text-size: 14px;">
                            ${courseCode}
                            <a onclick="clearCourse(${courseCode})"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5" d="M11.5956 22.0001H12.4044C15.1871 22.0001 16.5785 22.0001 17.4831 21.1142C18.3878 20.2283 18.4803 18.7751 18.6654 15.8686L18.9321 11.6807C19.0326 10.1037 19.0828 9.31524 18.6289 8.81558C18.1751 8.31592 17.4087 8.31592 15.876 8.31592H8.12405C6.59127 8.31592 5.82488 8.31592 5.37105 8.81558C4.91722 9.31524 4.96744 10.1037 5.06788 11.6807L5.33459 15.8686C5.5197 18.7751 5.61225 20.2283 6.51689 21.1142C7.42153 22.0001 8.81289 22.0001 11.5956 22.0001Z" fill="currentColor" />
                                <path d="M3 6.38597C3 5.90152 3.34538 5.50879 3.77143 5.50879L6.43567 5.50832C6.96502 5.49306 7.43202 5.11033 7.61214 4.54412C7.61688 4.52923 7.62232 4.51087 7.64185 4.44424L7.75665 4.05256C7.8269 3.81241 7.8881 3.60318 7.97375 3.41617C8.31209 2.67736 8.93808 2.16432 9.66147 2.03297C9.84457 1.99972 10.0385 1.99986 10.2611 2.00002H13.7391C13.9617 1.99986 14.1556 1.99972 14.3387 2.03297C15.0621 2.16432 15.6881 2.67736 16.0264 3.41617C16.1121 3.60318 16.1733 3.81241 16.2435 4.05256L16.3583 4.44424C16.3778 4.51087 16.3833 4.52923 16.388 4.54412C16.5682 5.11033 17.1278 5.49353 17.6571 5.50879H20.2286C20.6546 5.50879 21 5.90152 21 6.38597C21 6.87043 20.6546 7.26316 20.2286 7.26316H3.77143C3.34538 7.26316 3 6.87043 3 6.38597Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.42543 11.4815C9.83759 11.4381 10.2051 11.7547 10.2463 12.1885L10.7463 17.4517C10.7875 17.8855 10.4868 18.2724 10.0747 18.3158C9.66253 18.3592 9.29499 18.0426 9.25378 17.6088L8.75378 12.3456C8.71256 11.9118 9.01327 11.5249 9.42543 11.4815Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5747 11.4815C14.9868 11.5249 15.2875 11.9118 15.2463 12.3456L14.7463 17.6088C14.7051 18.0426 14.3376 18.3592 13.9254 18.3158C13.5133 18.2724 13.2126 17.8855 13.2538 17.4517L13.7538 12.1885C13.795 11.7547 14.1625 11.4381 14.5747 11.4815Z" fill="currentColor" />
                            </svg></a>
                            </h3>
                            <input type="hidden" name="selectedCoursesList[]" value="${courseCode}">
                            </li>`;
                            category.append(html);

                            $(`input[type="checkbox"][value=${selectedCourse}]`).prop("checked", true);


                        });


                    }
                }

                $('input[type="checkbox"]').change(function() {

                    // Retrieve the previously selected values from sessionStorage
                    let selectedCourses = JSON.parse(sessionStorage.getItem('selectedCourses')) || [];

                    // Get the value of the current checkbox
                    const courseCode = $(this).val();

                    // If the checkbox is checked and its value is not already in the selectedCourses array, add it and update sessionStorage
                    if ($(this).prop('checked') && !selectedCourses.includes(courseCode)) {
                        selectedCourses.push(courseCode);
                        sessionStorage.setItem('selectedCourses', JSON.stringify(selectedCourses));
                        console.log("cursos en sessionStorage: ", sessionStorage.getItem('selectedCourses'));

                        let category = '';
                        if (courseCode.startsWith("CCOM")) {
                            category = $('#concentracion');
                        } else if (generales.some(substr => courseCode.startsWith(substr))) {
                            category = $('#generales');
                        } else if (courseCode.startsWith("HUMA")) {
                            category = $('#humanidades');
                        } else if (courseCode.startsWith("CISO")) {
                            category = $('#cienciasSociales');
                        }
                        let html = `<li id="${courseCode}">
                                <h3 style="font-size: 12px;" class="justify-between -mx-4 mb-2 flex items-center  py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]" style="text-size: 14px;">
                                ${courseCode}
                                <a onclick="clearCourse(${courseCode})"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5" d="M11.5956 22.0001H12.4044C15.1871 22.0001 16.5785 22.0001 17.4831 21.1142C18.3878 20.2283 18.4803 18.7751 18.6654 15.8686L18.9321 11.6807C19.0326 10.1037 19.0828 9.31524 18.6289 8.81558C18.1751 8.31592 17.4087 8.31592 15.876 8.31592H8.12405C6.59127 8.31592 5.82488 8.31592 5.37105 8.81558C4.91722 9.31524 4.96744 10.1037 5.06788 11.6807L5.33459 15.8686C5.5197 18.7751 5.61225 20.2283 6.51689 21.1142C7.42153 22.0001 8.81289 22.0001 11.5956 22.0001Z" fill="currentColor" />
                                    <path d="M3 6.38597C3 5.90152 3.34538 5.50879 3.77143 5.50879L6.43567 5.50832C6.96502 5.49306 7.43202 5.11033 7.61214 4.54412C7.61688 4.52923 7.62232 4.51087 7.64185 4.44424L7.75665 4.05256C7.8269 3.81241 7.8881 3.60318 7.97375 3.41617C8.31209 2.67736 8.93808 2.16432 9.66147 2.03297C9.84457 1.99972 10.0385 1.99986 10.2611 2.00002H13.7391C13.9617 1.99986 14.1556 1.99972 14.3387 2.03297C15.0621 2.16432 15.6881 2.67736 16.0264 3.41617C16.1121 3.60318 16.1733 3.81241 16.2435 4.05256L16.3583 4.44424C16.3778 4.51087 16.3833 4.52923 16.388 4.54412C16.5682 5.11033 17.1278 5.49353 17.6571 5.50879H20.2286C20.6546 5.50879 21 5.90152 21 6.38597C21 6.87043 20.6546 7.26316 20.2286 7.26316H3.77143C3.34538 7.26316 3 6.87043 3 6.38597Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.42543 11.4815C9.83759 11.4381 10.2051 11.7547 10.2463 12.1885L10.7463 17.4517C10.7875 17.8855 10.4868 18.2724 10.0747 18.3158C9.66253 18.3592 9.29499 18.0426 9.25378 17.6088L8.75378 12.3456C8.71256 11.9118 9.01327 11.5249 9.42543 11.4815Z" fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5747 11.4815C14.9868 11.5249 15.2875 11.9118 15.2463 12.3456L14.7463 17.6088C14.7051 18.0426 14.3376 18.3592 13.9254 18.3158C13.5133 18.2724 13.2126 17.8855 13.2538 17.4517L13.7538 12.1885C13.795 11.7547 14.1625 11.4381 14.5747 11.4815Z" fill="currentColor" />
                                </svg></a>
                                </h3>
                                <input type="hidden" name="selectedCoursesList[]" value="${courseCode}">
                            </li>`;
                        category.append(html);
                    }

                    // If the checkbox is unchecked and its value is in the selectedCourses array, remove it and update sessionStorage
                    //console.log()
                    if (!$(this).prop('checked') && selectedCourses.includes(courseCode)) {
                        console.log("entra al if de unchecked y curso en la lista: ", courseCode);
                        clearCourse(courseCode);
                        // selectedCourses = selectedCourses.filter(item => item !== courseCode);
                        // sessionStorage.setItem('selectedCourses', JSON.stringify(selectedCourses));
                        // // Remove the corresponding <li> element
                        // $('li#' + value).remove();

                    }
                });


                // $('#confirmarConsejeria').click(function() {
                //     // $(this).prop("disabled", true);
                //     // $('input[type="checkbox"]').prop('disabled', true);
                //     // $('a[onClick]').remove();
                //     console.log('los cursos: ', selectedCoursesList);

                // });



            });
        </script>
        <!-- dropdown script -->
        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("dropdown", (initialOpenState = false) => ({
                    open: initialOpenState,

                    toggle() {
                        this.open = !this.open;
                    },
                }));
            });
        </script>
</body>

</html>