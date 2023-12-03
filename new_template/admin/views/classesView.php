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
        <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#4361ee">
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
        <div id="sidebar"></div>
        <!-- end sidebar section -->

        <div class="main-content flex flex-col min-h-screen">
            <!-- start header section -->
            <header class="z-40" :class="{'dark' : $store.app.semidark && $store.app.menu === 'horizontal'}">
                <div class="shadow-sm">
                <div class="relative flex w-full items-center" style="background-color: #2b2b2b; padding: 5px 5px; dark:bg-[#0e1726]">
                        <div class="horizontal-logo flex items-center justify-between ltr:mr-2 rtl:ml-2 lg:hidden">
                            <a href="index.html" class="main-logo flex shrink-0 items-center">
                                <img class="inline w-8 ltr:-ml-1 rtl:-mr-1" src="assets/images/university.png" alt="image" />
                                <span class="hidden align-middle text-2xl font-semibold transition-all duration-300 ltr:ml-1.5 rtl:mr-1.5 dark:text-white-light md:inline">CONSEJERIA UPRA</span>
                            </a>

                            <a href="javascript:;" class="collapse-icon flex flex-none rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary ltr:ml-2 rtl:mr-2 dark:bg-dark/40 dark:text-[#d0d2d6] dark:hover:bg-dark/60 dark:hover:text-primary lg:hidden" @click="$store.app.toggleSidebar()">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </a>
                        </div>
                        <div x-data="header" class="flex items-center space-x-1.5 ltr:ml-auto rtl:mr-auto rtl:space-x-reverse dark:text-[#d0d2d6] sm:flex-1 ltr:sm:ml-0 sm:rtl:mr-0 lg:space-x-2">
                            <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">
                            </div>


                            <div class="dropdown flex-shrink-0" x-data="dropdown" @click.outside="open = false">
                                <a href="javascript:;" class="block rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60" @click="toggle()">
                                    <span> <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                            <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                </a>
                                <!-- user-profile -->
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="top-11 w-[230px] !py-0 font-semibold text-dark ltr:right-0 rtl:left-0 dark:text-white-dark dark:text-white-light/90">
                                    <li class="border-t border-white-light dark:border-white-light/10">
                                        <a href="login.php" class="!py-3 text-danger" @click="toggle">
                                            <svg class="h-4.5 w-4.5 rotate-90 ltr:mr-2 rtl:ml-2" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.5" d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path d="M12 15L12 2M12 2L15 5.5M12 2L9 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    </ul>
                </div>
            </header>
            <!-- end header section -->

            <div class="animate__animated p-6" :class="[$store.app.animation]">

            <?php if (isset($_GET['message'])) { ?>
                    <div style='padding: 15px 0' class="flex flex-wrap items-center justify-between gap-4">
                            
                                <?php if ($_GET['message'] == 'failure')
                                        echo"<h2 style='color:red; bold' class='text-xl'>El curso ya está en oferta!</h2>";
                                     elseif ($_GET['message'] == "success") 
                                        echo "<h2 style='color:limegreen; bold' class='text-xl'>El curso fue añadido a la oferta!</h2>";
                                ?>
                        <br>
                    </div>
                <?php } ?>
                <!-- start main content section -->

                <!-- Create new term button -->
                <?php 
                if ($category == 'oferta') { ?>
                    
                    <div class="flex flex-wrap items-center justify-between gap-4">
                    <h2 class="text-xl">Cursos para el proximo semestre (<?php echo $term ?>)</h2>
                    <div class="flex w-full flex-col gap-4 sm:w-auto sm:flex-row sm:items-center sm:gap-3">
                    <div class="flex gap-3">
                    <div x-data="modal">
                <button type="button" class="btn btn-primary !mt-6" @click="toggle">Crear term nuevo</button>
                <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
                    <div class="flex min-h-screen items-start justify-center px-4" @click.self="open = false">
                        <div
                            x-show="open"
                            x-transition
                            x-transition.duration.300
                            class="panel my-8 w-full max-w-[300px] overflow-hidden rounded-lg border-0 bg-secondary p-0 dark:bg-secondary"
                            style='background-color: white'
                        >
                            <div class="flex items-center justify-end pt-4 text-white ltr:pr-4 rtl:pl-4 dark:text-white-light">
                                
                            </div>
                            <div class="p-5">
                                <form action="?newterm" method="POST">
                                <div class="py-5 text-center text-white dark:text-white-light">
                                    <p style='color:black'><b>WARNING:</b> Esto borrará la data de consejería del semestre pasado con excepción de los cursos aconsejados!!</p><br>
                                    <label for='term' style='color:black'>Código (term) para próximo semestre: </label>
                                    <input style='color:black' size="3" maxlength="3" name='term' type='text' placeholder='' 
                                    class='form-input' required>
                                </div>
                                <div class="flex justify-center gap-4 p-5">

                                    <button type="submit" class="btn btn-primary !mt-6">Crear term</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
                </div>
                </div>
        <br>

                        

            <?php } else { ?>
                <!-- Create class buttons -->
                <div class="flex flex-wrap items-center justify-between gap-4">
                            <h2 class="text-xl">Cursos Por Categoría</h2>
                            
                            <div class="flex w-full flex-col gap-4 sm:w-auto sm:flex-row sm:items-center sm:gap-3">
                                <div class="flex gap-3">
                                    <div>
                                        <form action="?createclass=CCOM" method="POST">
                                        <button type="submit" class="btn btn-primary">
                                        <svg
                                                    class="shrink-0 group-hover:!text-primary"
                                                    width="20"
                                                    height="20"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        opacity="0.5"
                                                        d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        fill-rule="evenodd"
                                                        clip-rule="evenodd"
                                                        d="M12 5.25C12.4142 5.25 12.75 5.58579 12.75 6V7.25H14C14.4142 7.25 14.75 7.58579 14.75 8C14.75 8.41421 14.4142 8.75 14 8.75L12.75 8.75L12.75 10C12.75 10.4142 12.4142 10.75 12 10.75C11.5858 10.75 11.25 10.4142 11.25 10L11.25 8.75H9.99997C9.58575 8.75 9.24997 8.41421 9.24997 8C9.24997 7.58579 9.58575 7.25 9.99997 7.25H11.25L11.25 6C11.25 5.58579 11.5858 5.25 12 5.25ZM7.25 14C7.25 13.5858 7.58579 13.25 8 13.25H16C16.4142 13.25 16.75 13.5858 16.75 14C16.75 14.4142 16.4142 14.75 16 14.75H8C7.58579 14.75 7.25 14.4142 7.25 14ZM8.25 18C8.25 17.5858 8.58579 17.25 9 17.25H15C15.4142 17.25 15.75 17.5858 15.75 18C15.75 18.4142 15.4142 18.75 15 18.75H9C8.58579 18.75 8.25 18.4142 8.25 18Z"
                                                        fill="currentColor"
                                                    />
                                                </svg> 
                                            &nbsp Crear curso (CCOM)
                                        </button> </form>
                                    </div>
                                    <div>
                                        <form action="?createclass=General" method="POST">
                                        <button type="submit" class="btn btn-primary">
                                        <svg
                                                    class="shrink-0 group-hover:!text-primary"
                                                    width="20"
                                                    height="20"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        opacity="0.5"
                                                        d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        fill-rule="evenodd"
                                                        clip-rule="evenodd"
                                                        d="M12 5.25C12.4142 5.25 12.75 5.58579 12.75 6V7.25H14C14.4142 7.25 14.75 7.58579 14.75 8C14.75 8.41421 14.4142 8.75 14 8.75L12.75 8.75L12.75 10C12.75 10.4142 12.4142 10.75 12 10.75C11.5858 10.75 11.25 10.4142 11.25 10L11.25 8.75H9.99997C9.58575 8.75 9.24997 8.41421 9.24997 8C9.24997 7.58579 9.58575 7.25 9.99997 7.25H11.25L11.25 6C11.25 5.58579 11.5858 5.25 12 5.25ZM7.25 14C7.25 13.5858 7.58579 13.25 8 13.25H16C16.4142 13.25 16.75 13.5858 16.75 14C16.75 14.4142 16.4142 14.75 16 14.75H8C7.58579 14.75 7.25 14.4142 7.25 14ZM8.25 18C8.25 17.5858 8.58579 17.25 9 17.25H15C15.4142 17.25 15.75 17.5858 15.75 18C15.75 18.4142 15.4142 18.75 15 18.75H9C8.58579 18.75 8.25 18.4142 8.25 18Z"
                                                        fill="currentColor"
                                                    />
                                                </svg> 
                                            &nbsp Crear curso (General)
                                        </button> </form>
                                    </div>
                                   
                                </div>

                                
                            </div>
                        </div> <br>
                    <?php } ?>


                <!-- Classes -->
                <div class="mb-5 flex flex-col sm:flex-row" x-data="{ tab: '<?php echo $category ?>'}"> 
                <div class="mx-10 mb-5 sm:mb-0">
                    <ul class="w-24 m-auto text-center font-semibold">
                        <li>
                            </li>
                        <li>
                            <a href="?classes" class="p-3.5 py-4 -mb-[1px] block ltr:border-r rtl:border-l border-white-light dark:border-[#191e3a] relative before:transition-all before:duration-700 hover:text-secondary before:absolute before:w-[1px] before:bottom-0 before:top-0 ltr:before:-right-[1px] rtl:before:-left-[1px] before:m-auto before:h-0 hover:before:h-[80%] before:bg-secondary" :class="{'text-secondary before:!h-[80%]' : tab === 'concentracion'}" @click="tab='concentracion'">Cursos de CCOM</a>
                        <li>
                            <a href="?ccomelectives" class="p-3.5 py-4 -mb-[1px] block ltr:border-r rtl:border-l border-white-light dark:border-[#191e3a] relative before:transition-all before:duration-700 hover:text-secondary before:absolute before:w-[1px] before:bottom-0 before:top-0 ltr:before:-right-[1px] rtl:before:-left-[1px] before:m-auto before:h-0 before:bg-secondary hover:before:h-[80%]" :class="{'text-secondary before:!h-[80%]' : tab === 'electivas'}">Electivas CCOM</a>
                        </li>
                        <li>
                            <a href="?generalclasses" class="p-3.5 py-4 -mb-[1px] block ltr:border-r rtl:border-l border-white-light dark:border-[#191e3a] relative before:transition-all before:duration-700 hover:text-secondary before:absolute before:w-[1px] before:bottom-0 before:top-0 ltr:before:-right-[1px] rtl:before:-left-[1px] before:m-auto before:h-0 before:bg-secondary hover:before:h-[80%]" :class="{'text-secondary before:!h-[80%]' : tab === 'generales'}">Cursos generales</a>
                        </li>
                        <li>
                            <a href="?offer" class="p-3.5 py-4 -mb-[1px] block ltr:border-r rtl:border-l border-white-light dark:border-[#191e3a] relative before:transition-all before:duration-700 hover:text-secondary before:absolute before:w-[1px] before:bottom-0 before:top-0 ltr:before:-right-[1px] rtl:before:-left-[1px] before:m-auto before:h-0 before:bg-secondary hover:before:h-[80%]" :class="{'text-secondary before:!h-[80%]' : tab === 'oferta'}">Cursos en oferta</a>
                        </li>
                    </ul>
                </div>


<!-- $courseCategories = array("concentracion", "electivas", "generales"); -->


    <div class='flex-1 text-sm' x-show='tab === "<?php echo $category ?>"'>
    <div class="border border-[#d3d3d3] dark:border-[#1b2e4b] rounded">
            <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
            <div class="table-responsive">
            <table style='text-align:center'>
                <thead>
                    <tr>
                        <th style='text-align:center'>Codigo</th>
                        <th style='text-align:center'>Nombre</th>
                        <th style='text-align:center'>Créditos</th>
                        <?php if ($category != 'oferta') { ?>
                        <th style='text-align:center'></th>
                        <?php } else { ?>
                        <th style='text-align:center'>Registrados</th>
                        <th style='text-align:center'></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

    <?php 
    foreach ($courses as $course) {
        $courseCode = $course['crse_code'];
        $courseName = $course['name'];
        $credits = $course['credits'];
        $controller = new ClassesController();
        $matriculados = $controller->getMatriculados($courseCode);
        //$matriculados = 5;
        echo "
            <tr style='text-align:center'>
            
                <td style='text-align:center'><a style='cursor: pointer' title='Editar' href='?class=$courseCode'>$courseCode</a></td>
            
                <td style='text-align:center'>$courseName</td>
                <td style='text-align:center'>$credits</td> ";
                
                if($category !== 'oferta')
                    echo "<td style='text-align:center; vertical-align:middle'><a href='?addOffer&code=$courseCode'>
                    <span class='badge whitespace-nowrap badge-outline-primary'>Añade a oferta</span>";
                
                else {
                    echo "<td style='text-align:center; vertical-align:middle'>
                    <a href='?lista&class=$courseCode'>
                        <svg class='shrink-0 group-hover:!text-primary' width='20' height='20' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' style='display: block; margin: auto'>
                            <circle opacity='0.5' cx='15' cy='6' r='3' fill='currentColor' />
                            <ellipse opacity='0.5' cx='16' cy='17' rx='5' ry='3' fill='currentColor' />
                            <circle cx='9.00098' cy='6' r='4' fill='currentColor' />
                            <ellipse cx='9.00098' cy='17.001' rx='7' ry='4' fill='currentColor' />
                        </svg>
                         ($matriculados)
                    </a>
                    </td>     
                <td style='text-align:center; vertical-align:middle; horizontal-align: middle'><a href='?removeOffer&code=$courseCode'>
                <span class='badge whitespace-nowrap badge-outline-danger'>Remueve de oferta</span>";
                }

                echo"</a>
                </td>                                                    
            </tr>"; 
    } ?>
    </tbody>
            </table>
        </div>
    </div>
</div>

                <!-- description -->
               
                <!-- <div x-data="modal">
                <button type="button" class="btn btn-primary !mt-6" @click="toggle">Someter</button>
                <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="open && '!block'">
                    <div class="flex min-h-screen items-start justify-center px-4" @click.self="open = false">
                        <div
                            x-show="open"
                            x-transition
                            x-transition.duration.300
                            class="panel my-8 w-full max-w-[300px] overflow-hidden rounded-lg border-0 bg-secondary p-0 dark:bg-secondary"
                        >
                            <div class="flex items-center justify-end pt-4 text-white ltr:pr-4 rtl:pl-4 dark:text-white-light">
                                
                            </div>
                            <div class="p-5">
                                <div class="py-5 text-center text-white dark:text-white-light">
                                    <p class="font-semibold">Su cohorte ha sido creado / actualizado.</p>
                                </div>
                                <div class="flex justify-center gap-4 p-5">
                                    <button type="button" @click="toggle" class="btn dark:btn-dark bg-white text-black">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
                  
                                                
                <!-- end main content section -->

            </div>

            </div>
    </div>
            <!-- start footer section -->
            <div class="p-6 pt-0 mt-auto text-center dark:text-white-dark ltr:sm:text-left rtl:sm:text-right">
                © <span id="footer-year">2022</span>. UPRA All rights reserved.
            </div>
            <!-- end footer section -->
        

    <script src="assets/js/alpine-collaspe.min.js"></script>
    <script src="assets/js/alpine-persist.min.js"></script>
    <script defer src="assets/js/alpine-ui.min.js"></script>
    <script defer src="assets/js/alpine-focus.min.js"></script>
    <script defer src="assets/js/alpine.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


    <script>

        if (sessionStorage.getItem('csv_content')) {
            // Create a Blob from the CSV content
            var blob = new Blob([sessionStorage.getItem('csv_content')], { type: 'application/csv' });

            // Create a link element to trigger the download
            var a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = 'Report.csv';
            document.body.appendChild(a);

            // Trigger the click event to initiate the download
            a.click();

            // Remove the link element
            document.body.removeChild(a);

            // Clear the session variable
            sessionStorage.removeItem('csv_content');
        }

        $(document).ready(function(){
            $("#sidebar").load("sidebar.php");
        });

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


            }));
        });

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

            Alpine.data('app', () => ({
                    showUploadModal: false,
                    formData: {
                        file: null,
                    },
                    openUploadModal() {
                        this.showUploadModal = true;
                    },
                    closeUploadModal() {
                        this.showUploadModal = false;
                    },
                    submitForm() {
                        // Aquí puedes realizar acciones con el archivo seleccionado, como enviarlo a un servidor.
                        // Luego, cierra el modal.
                        if (this.formData.file) {
                            console.log("Archivo seleccionado:", this.formData.file);
                            // Aquí puedes realizar las acciones necesarias con el archivo.
                        } else {
                            console.log("Ningún archivo seleccionado.");
                        }
                        this.showUploadModal = false;
                    },
                
                }));
        });
    </script>
</body>

<?php
    // Check if the session variables are set
    if (isset($_SESSION['csv_content'], $_SESSION['filename'])) {
        // Output the CSV content in a JavaScript block
        echo '<script>';
        echo 'var csvContent = ' . json_encode($_SESSION['csv_content']) . ';';
        echo 'var csvFileName = "' . $_SESSION['filename'] . '";';
        echo 'console.log(csvContent);';  // For debugging purposes
        echo 'console.log(csvFileName);';  // For debugging purposes
        echo 'var blob = new Blob([csvContent], { type: "application/csv" });';
        echo 'var a = document.createElement("a");';
        echo 'a.href = URL.createObjectURL(blob);';
        echo 'a.download = csvFileName;';
        echo '  document.body.appendChild(a);';
        echo '  a.click();';
        echo '  document.body.removeChild(a);';
        echo '  sessionStorage.removeItem("csv_content");';
        echo '  sessionStorage.removeItem("filename");';
        echo '</script>';

        // Clear the session variables
        unset($_SESSION['csv_content'], $_SESSION['filename']);
    }
    ?>

</html>