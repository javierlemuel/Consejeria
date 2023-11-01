<?php
// $obj = new ExpedienteController();
// $info = $obj->get();
if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
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
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/estilos.css" />
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script defer src="assets/js/popper.min.js"></script>
    <script defer src="assets/js/tippy-bundle.umd.min.js"></script>
    <script defer src="assets/js/sweetalert.min.js"></script>
</head>

<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]">
    <!-- sidebar menu overlay -->
    <div x-cloak class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>

    <!-- screen loader -->
    <div class="screen_loader animate__animated fixed inset-0 z-[60] grid place-content-center bg-[#fafafa] dark:bg-[#060818]">
        <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
            <path d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s" repeatCount="indefinite" />
            </path>
            <path d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="360 67 67" dur="8s" repeatCount="indefinite" />
            </path>
        </svg>
    </div>

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
            <?php include('layouts/header.php'); ?>

            <div class="animate__animated p-6" :class="[$store.app.animation]">
                <!-- start main content section -->
                <!-- Vertical line tabs -->
                <div class="mb-5 flex flex-col sm:flex-row" x-data="{ tab: 'info'}"> <!-- Cambiamos 'tab' a 'info' por defecto -->
                    <!-- buttons -->
                    <div class="mx-10 mb-5 sm:mb-0">
                        <ul class="w-24 m-auto text-center font-semibold">
                            <li>
                                <a href="javascript:" class="p-3.5 py-4 -mb-[1px] block ltr:border-r rtl:border-l border-white-light dark:border-[#191e3a] relative before:transition-all before:duration-700 hover:text-secondary before:absolute before:w-[1px] before:bottom-0 before:top-0 ltr:before:-right-[1px] rtl:before:-left-[1px] before:m-auto before:h-0 hover:before:h-[80%] before:bg-secondary" :class="{'text-secondary before:!h-[80%]' : tab === 'info'}" @click="tab='info'">Informacion Basica</a>
                            </li>
                            <li>
                                <a href="javascript:" class="p-3.5 py-4 -mb-[1px] block ltr:border-r rtl:border-l border-white-light dark:border-[#191e3a] relative before:transition-all before:duration-700 hover:text-secondary before:absolute before:w-[1px] before:bottom-0 before:top-0 ltr:before:-right-[1px] rtl:before:-left-[1px] before:m-auto before:h-0 before:bg-secondary hover:before:h-[80%]" :class="{'text-secondary before:!h-[80%]' : tab === 'expediente'}" @click="tab='expediente'">Expediente Academico</a>
                            </li>
                        </ul>
                    </div>

                    <!-- description -->
                    <div class="flex-1 text-sm ">
                        <template x-if="tab === 'info'">
                            <div>
                                <h4 class="font-semibold text-2xl mb-4">Informacion Basica:</h4>
                                <p class="mb-4"><b>Nombre:</b> <?php echo $studentInfo["full_student_name"]; ?></p>
                                <p class="mb-4"><b>Correo Electronico:</b> <?php echo $studentInfo["email"]; ?></p>
                                <p class="mb-4"><b>Numero de Estudiante:</b> <?php echo $studentInfo["formatted_student_num"]; ?></p>
                                <p class="mb-4"><b>Major:</b> CCOM</p>
                                <p class="mb-4">Si alguna de esta informacion esta incorrecta favor de avisarle a la consejera. </p>
                            </div>
                        </template>
                        <template x-if="tab === 'expediente'">
                            <div>
                                <div class="row flex">
                                    <div class="grid-cols-1" style="width:70%;">
                                        <h4 class="font-semibold text-2xl mb-4">Expediente academico</h4>
                                    </div>
                                    <div class="grid-cols-1">
                                        <p>Universidad de Puerto Rico en Arecibo</p>
                                        <p>Departamento de Ciencias de Computos</p>

                                    </div>
                                </div>
                                <div class="row flex">
                                    <div class="grid-cols-1 justify-end" style="width:20%;">
                                        <p><b>Nombre:</b></p>
                                    </div>
                                    <div class="grid-cols-1" style="width:50%;">
                                        <p><?php echo $studentInfo["full_student_name"]; ?></p>
                                    </div>
                                    <div class="grid-cols-1">
                                        <p><b>Año: </b>1</p>
                                    </div>
                                </div>
                                <div class="row flex">
                                    <div class="grid-cols-1" style="width:20%;">
                                        <p><b>Numero de Estudiante:</b> </p>
                                    </div>
                                    <div class="grid-cols-1" style="width:50%;">
                                        <p><?php echo $studentInfo["formatted_student_num"]; ?></p>
                                    </div>
                                    <div class="grid-cols-1">
                                        <p><b>Semestre: </b>2</p>
                                    </div>
                                </div>
                                <div class="row flex">
                                    <div class="grid-cols-1" style="width:20%;">
                                        <p><b>Correo electronico:</b> </p>
                                    </div>
                                    <div class="grid-cols-1" style="width:50%;">
                                        <p><?php echo $studentInfo["email"]; ?></p>
                                    </div>
                                    <div class="grid-cols-1">
                                        <p><b>Creditos Recomendados:</b> 14</p>
                                    </div>
                                </div>
                                <div class="row flex">
                                    <div class="grid-cols-1" style="width:70%;">
                                    </div>
                                    <div class="grid-cols-1">
                                        <p><b>GPA Departamental:</b> 4.00</p>
                                    </div>
                                </div>
                                <div class="row flex">
                                    <div class="grid-cols-1" style="width:70%;">
                                    </div>
                                    <div class="grid-cols-1">
                                        <p><b>GPA General:</b> 3.50</p>
                                    </div>
                                </div>
                                <!-- start expediente table -->
                                <!-- clases de concentracion -->
                                <div class="table-responsive">
                                    <h4 class="font-semibold text-2xl mb-4">Cursos de Concentracion</h4>
                                    <table class="table-striped">
                                        <thead>
                                            <tr>
                                                <th>Curso</th>
                                                <th>Descripcion</th>
                                                <th>Creditos</th>
                                                <th class="text-center">Notas</th>
                                                <th class="text-center">Matriculado</th>
                                                <th class="text-center">Recomendado</th>
                                                <th class="text-center">Convalidacion</th>
                                                <th class="text-center">Equivalencia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ccomStudentCourses as $ccomStudentCourse) : ?>
                                                <tr>
                                                    <td class="whitespace-nowrap"><?php echo $ccomStudentCourse['crse_code'] ?></td>
                                                    <td><?php echo $ccomStudentCourse['name'] ?></td>
                                                    <td><?php echo $ccomStudentCourse['credits'] ?> </td>
                                                    <td><?php if ($ccomStudentCourse['crse_grade'] == 'NULL')
                                                            echo '';
                                                        else echo $ccomStudentCourse['crse_grade'] ?></td>
                                                    <td><?php if ($ccomStudentCourse['term'] == 'NULL')
                                                            echo '';
                                                        else echo $ccomStudentCourse['term'] ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php if ($ccomStudentCourse['equivalencia'] == 'NULL')
                                                            echo '';
                                                        else echo $ccomStudentCourse['equivalencia'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                    <div>Creditos Departamentales:</div>
                                                </th>
                                                <th>
                                                    <div>53</div>
                                                </th>
                                                <th>
                                                    <div></div>
                                                </th>
                                                <th class="p-3 text-center">
                                                    <div></div>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- clases generales -->
                                <div class="table-responsive mt-5">
                                    <h4 class="font-semibold text-2xl my-4">Cursos Generales</h4>
                                    <table class="table-striped">
                                        <thead>
                                            <tr>
                                                <th>Curso</th>
                                                <th>Descripcion</th>
                                                <th>Creditos</th>
                                                <th class="text-center">Notas</th>
                                                <th class="text-center">Matriculado</th>
                                                <th class="text-center">Recomendado</th>
                                                <th class="text-center">Convalidacion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($generalesStudentCourses as $generalesStudentCourse) : ?>
                                                <tr>
                                                    <td class="whitespace-nowrap"><?php echo $generalesStudentCourse['crse_code'] ?></td>
                                                    <td><?php echo $generalesStudentCourse['name'] ?></td>
                                                    <td><?php echo $generalesStudentCourse['credits'] ?> </td>
                                                    <td><?php if ($generalesStudentCourse['crse_grade'] == 'NULL')
                                                            echo '';
                                                        else echo $generalesStudentCourse['crse_grade'] ?></td>
                                                    <td><?php if ($generalesStudentCourse['term'] == 'NULL')
                                                            echo '';
                                                        else echo $generalesStudentCourse['term'] ?></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                    <div>Creditos Generales:</div>
                                                </th>
                                                <th>
                                                    <div>54</div>
                                                </th>
                                                <th>
                                                    <div></div>
                                                </th>
                                                <th class="p-3 text-center">
                                                    <div></div>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- electivas departamentales -->
                                <div class="table-responsive mt-5">
                                    <h4 class="font-semibold text-2xl my-4">Electivas Departamentales</h4>
                                    <table class="table-striped">
                                        <thead>
                                            <tr>
                                                <th>Curso</th>
                                                <th>Descripcion</th>
                                                <th>Creditos</th>
                                                <th class="text-center">Notas</th>
                                                <th class="text-center">Matriculado</th>
                                                <th class="text-center">Recomendado</th>
                                                <th class="text-center">Convalidacion</th>
                                                <th class="text-center">Equivalencia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="whitespace-nowrap"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                    <div>Creditos Electivas Departamentales:</div>
                                                </th>
                                                <th>
                                                    <div></div>
                                                </th>
                                                <th>
                                                    <div></div>
                                                </th>
                                                <th class="p-3 text-center">
                                                    <div></div>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- electivas libres -->
                                <div class="table-responsive mt-5">
                                    <h4 class="font-semibold text-2xl my-4">Electivas Libres</h4>
                                    <table class="table-striped">
                                        <thead>
                                            <tr>
                                                <th>Curso</th>
                                                <th>Descripcion</th>
                                                <th>Creditos</th>
                                                <th class="text-center">Notas</th>
                                                <th class="text-center">Matriculado</th>
                                                <th class="text-center">Recomendado</th>
                                                <th class="text-center">Convalidacion</th>
                                                <th class="text-center">Equivalencia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="whitespace-nowrap"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                    <div>Creditos Electivas Libres:</div>
                                                </th>
                                                <th>
                                                    <div></div>
                                                </th>
                                                <th>
                                                    <div></div>
                                                </th>
                                                <th class="p-3 text-center">
                                                    <div></div>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </template>
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
    <script src="assets/js/courses.js"></script>

    <script>
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

                messages: [{
                        id: 1,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-success-light dark:bg-success text-success dark:text-success-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></span>',
                        title: 'Congratulations!',
                        message: 'Your OS has been updated.',
                        time: '1hr',
                    },
                    {
                        id: 2,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-info-light dark:bg-info text-info dark:text-info-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></span>',
                        title: 'Did you know?',
                        message: 'You can switch between artboards.',
                        time: '2hr',
                    },
                    {
                        id: 3,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-danger-light dark:bg-danger text-danger dark:text-danger-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>',
                        title: 'Something went wrong!',
                        message: 'Send Reposrt',
                        time: '2days',
                    },
                    {
                        id: 4,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-warning-light dark:bg-warning text-warning dark:text-warning-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">    <circle cx="12" cy="12" r="10"></circle>    <line x1="12" y1="8" x2="12" y2="12"></line>    <line x1="12" y1="16" x2="12.01" y2="16"></line></svg></span>',
                        title: 'Warning',
                        message: 'Your password strength is low.',
                        time: '5days',
                    },
                ],

                removeMessage(value) {
                    this.messages = this.messages.filter((d) => d.id !== value);
                },
            }));
        });
        // elec script

        const clearCourse = (course, elements, category) => {
            var query = document.getElementById(course).value; /* Value inputted by user */
            var elements = document.getElementsByClassName(elements); /* Get the li elements in the list */
            var myList = document.getElementById(category); /* Var to reference the list */
            var length = (document.getElementsByClassName(element).length); /* # of li elements */
            var checker = 'false'; /* boolean-ish value to determine if value was found */

            myList.querySelectorAll('li').forEach(function(item) {
                if (item.innerHTML.indexOf(query) !== -1)
                    item.remove();
            });
        }

        const clearCourses = (courses) => {
            document.getElementById(courses).innerHTML = "";
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
    </script>
</body>

</html>