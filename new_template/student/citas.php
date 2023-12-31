<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>VRISTO - Multipurpose Tailwind Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" type="image/x-icon" href="favicon.png" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" media="screen" href="assets/css/perfect-scrollbar.min.css" />
        <link href="assets/css/fullcalendar.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
        <link defer rel="stylesheet" type="text/css" media="screen" href="assets/css/animate.css" />
        <script src="assets/js/perfect-scrollbar.min.js"></script>
        <script defer src="assets/js/popper.min.js"></script>
        <script defer src="assets/js/tippy-bundle.umd.min.js"></script>
        <script defer src="assets/js/sweetalert.min.js"></script>
    </head>

    <body
        x-data="main"
        class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased"
        :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]"
    >
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
            <div :class="{'dark text-white-dark' : $store.app.semidark}">
            <nav x-data="sidebar" class="sidebar fixed top-0 bottom-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300">
                <div class="h-full bg-white dark:bg-[#0e1726]">
                    <div class="flex items-center justify-between px-4 py-3">
                        <a href="index.html" class="main-logo flex shrink-0 items-center">
                            <img class="ml-[5px] w-8 flex-none" src="assets/images/university.png" alt="image" />
                            <span style='font-size: 20px' class="align-middle text-2xl font-semibold ltr:ml-1.5 rtl:mr-1.5 dark:text-white-light lg:inline">CONSEJERIA UPRA</span>
                        </a>
                        <a href="javascript:;" class="collapse-icon flex h-8 w-8 items-center rounded-full transition duration-300 hover:bg-gray-500/10 rtl:rotate-180 dark:text-white-light dark:hover:bg-dark-light/10" @click="$store.app.toggleSidebar()">
                            <svg class="m-auto h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                    <ul class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold" x-data="{ activeDropdown: 'users' }">


                        <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                            <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                            </svg>
                            <span>Pedro Reyes Reyes</span>
                        </h2>

                        <h3 style="font-size: 12px;" class="-mx-4 mb-1 flex items-center py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                            <span>840-22-1234</span>
                        </h3>

                        <h3 style="font-size: 12px;" class="-mx-4 mb-2 flex items-center py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]" style="text-size: 14px;">
                            pedro.reyes4@upr.edu
                        </h3>

                        <h3 style="font-size: 12px;" class="-mx-4 mb-2 flex items-center  py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]" style="text-size: 14px;">
                            1er Semestre 2023
                        </h3>

                        <h3 style="font-size: 12px;" class="-mx-4 mb-2 flex items-center  py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]" style="text-size: 14px;">
                            Creditos aprobados: 0
                        </h3>

                        <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                            <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                            </svg>
                            <span>Concentracion</span>
                        </h2>
                        <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                            <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                            </svg>
                            <span>Generales</span>
                        </h2>
                        <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                            <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                            </svg>
                            <span>Humanidades</span>
                        </h2>
                        <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                            <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                            </svg>
                            <span>Ciencias Sociales</span>
                        </h2>
                        <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                            <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                            </svg>
                            <span>Electivas Departamentales</span>
                        </h2>
                        <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                            <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                            </svg>
                            <span>Electivas Libres</span>
                            <button style="align-self:right" onclick="clearCourses('elec')">X</button>
                        </h2>
                        <ul id="elec">
                            <li id="INGL3131">
                                <h3 style="font-size: 12px;" class="ingl -mx-4 mb-2 flex items-center  py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]" style="text-size: 14px;">
                                    INGL3131
                                    <button style="align-self:right" onclick="clearCourse('INGL3131', 'ingl', 'elec')">X</button>
                                </h3>
                            </li>
                            <li id="INGL3133">
                                <h3 style="font-size: 12px;" class="ingl -mx-4 mb-2 flex items-center  py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]" style="text-size: 14px;">
                                    INGL3133
                                    <button style="align-self:right" onclick="clearCourse('INGL3133', 'ingl', 'elec')">X</button>
                                </h3>
                            </li>
                        </ul>



                    </ul>
                </div>
            </nav>
        </div>
            <!-- end sidebar section -->

            <div class="main-content flex flex-col min-h-screen">
                <!-- start header section -->
                <header class="z-40" :class="{'dark' : $store.app.semidark && $store.app.menu === 'horizontal'}">
                <div class="shadow-sm">
                    <div class="relative flex w-full items-center bg-warning px-5 py-2.5 dark:bg-[#0e1726]">
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
                        <div class="hidden ltr:mr-2 rtl:ml-2 sm:block">
                            <ul class="flex items-center space-x-4 rtl:space-x-reverse dark:text-[#d0d2d6]">
                                <li>
                                    <a href="index.php" class="block p-2 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60 border-b border-transparent hover:border-primary text-lg font-bold">
                                        Consejería
                                    </a>
                                </li>

                                <li>
                                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                        <button class="btn-link hover:text-primary text-lg font-bold relative" @click="toggle">
                                            Cohorte<!--<span class="dropdown-arrow"></span>-->
                                        </button>
                                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 whitespace-nowrap">
                                            <li><a href="cohorte2017.php" @click="toggle" class="block p-2 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60 border-b border-transparent hover:border-primary text-lg font-bold">2017</a></li>
                                            <li><a href="cohorte2022.php" @click="toggle" class="block p-2 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60 border-b border-transparent hover:border-primary text-lg font-bold">2022</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <a href="expediente.php" class="block p-2 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60 border-b border-transparent hover:border-primary text-lg font-bold">
                                        Expediente
                                    </a>
                                </li>

                                <li>
                                    <a href="citas.php" class="block p-2 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60 border-b border-transparent hover:border-primary text-lg font-bold">
                                        Citas
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div x-data="header" class="flex items-center space-x-1.5 ltr:ml-auto rtl:mr-auto rtl:space-x-reverse dark:text-[#d0d2d6] sm:flex-1 ltr:sm:ml-0 sm:rtl:mr-0 lg:space-x-2">
                            <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">
                            </div>


                            <div class="dropdown" x-data="dropdown" @click.outside="open = false">
                                <a href="javascript:;" class="block rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60" @click="toggle">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 10C22.0185 10.7271 22 11.0542 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M6 8L8.1589 9.79908C9.99553 11.3296 10.9139 12.0949 12 12.0949C13.0861 12.0949 14.0045 11.3296 15.8411 9.79908" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <circle cx="19" cy="5" r="3" stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="top-11 w-[300px] !py-0 text-xs text-dark ltr:-right-16 rtl:-left-16 dark:text-white-dark sm:w-[375px] sm:ltr:-right-2 sm:rtl:-left-2">
                                    <li class="mb-5">
                                        <div class="relative overflow-hidden rounded-t-md !p-5 text-white">
                                            <div class="absolute inset-0 h-full w-full bg-[url('../images/menu-heade.jpg')] bg-cover bg-center bg-no-repeat"></div>
                                            <h4 class="relative z-10 text-lg font-semibold">Messages</h4>
                                        </div>
                                    </li>
                                    <template x-for="msg in messages">
                                        <li>
                                            <div class="flex items-center px-5 py-3" @click.self="toggle">
                                                <div x-html="msg.image"></div>
                                                <span class="px-3 dark:text-gray-500">
                                                    <div class="text-sm font-semibold dark:text-white-light/90" x-text="msg.title"></div>
                                                    <div x-text="msg.message"></div>
                                                </span>
                                                <span class="whitespace-pre rounded bg-white-dark/20 px-1 font-semibold text-dark/60 ltr:ml-auto ltr:mr-2 rtl:mr-auto rtl:ml-2 dark:text-white-dark" x-text="msg.time"></span>
                                                <button type="button" class="text-neutral-300 hover:text-danger" @click="removeMessage(msg.id)">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                                                        <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </li>
                                    </template>
                                    <template x-if="messages.length">
                                        <li class="mt-5 border-t border-white-light text-center dark:border-white/10">
                                            <div class="group flex cursor-pointer items-center justify-center px-4 py-4 font-semibold text-primary dark:text-gray-400" @click="toggle">
                                                <span class="group-hover:underline ltr:mr-1 rtl:ml-1">VIEW ALL ACTIVITIES</span>
                                                <svg class="h-4 w-4 transition duration-300 group-hover:translate-x-1 ltr:ml-1 rtl:mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </li>
                                    </template>
                                    <template x-if="!messages.length">
                                        <li class="mb-5">
                                            <div class="!grid min-h-[200px] place-content-center text-lg hover:!bg-transparent">
                                                <div class="mx-auto mb-4 rounded-full text-primary ring-4 ring-primary/30">
                                                    <svg width="40" height="40" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.5" d="M20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.5228 4.47715 20 10 20C15.5228 20 20 15.5228 20 10Z" fill="currentColor" />
                                                        <path d="M10 4.25C10.4142 4.25 10.75 4.58579 10.75 5V11C10.75 11.4142 10.4142 11.75 10 11.75C9.58579 11.75 9.25 11.4142 9.25 11V5C9.25 4.58579 9.58579 4.25 10 4.25Z" fill="currentColor" />
                                                        <path d="M10 15C10.5523 15 11 14.5523 11 14C11 13.4477 10.5523 13 10 13C9.44772 13 9 13.4477 9 14C9 14.5523 9.44772 15 10 15Z" fill="currentColor" />
                                                    </svg>
                                                </div>
                                                No data available.
                                            </div>
                                        </li>
                                    </template>
                                </ul>
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
                                        <a href="auth-boxed-signin.html" class="!py-3 text-danger" @click="toggle">
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
                    <!-- start main content section -->

                    <div x-data="calendar">
                        <div class="panel">
                            <div class="mb-5">
                                <div class="mb-4 flex flex-col items-center justify-center sm:flex-row sm:justify-between">
                                    <div class="mb-4 sm:mb-0">
                                        <div class="text-center text-lg font-semibold ltr:sm:text-left rtl:sm:text-right">Calendar</div>
                                        <div class="mt-2 flex flex-wrap items-center justify-center sm:justify-start">
                                            <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                                <div class="h-2.5 w-2.5 rounded-sm bg-primary ltr:mr-2 rtl:ml-2"></div>
                                                <div>Work</div>
                                            </div>
                                            <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                                <div class="h-2.5 w-2.5 rounded-sm bg-info ltr:mr-2 rtl:ml-2"></div>
                                                <div>Travel</div>
                                            </div>
                                            <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                                <div class="h-2.5 w-2.5 rounded-sm bg-success ltr:mr-2 rtl:ml-2"></div>
                                                <div>Personal</div>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="h-2.5 w-2.5 rounded-sm bg-danger ltr:mr-2 rtl:ml-2"></div>
                                                <div>Important</div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" @click="editEvent()">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24px"
                                            height="24px"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="h-5 w-5 ltr:mr-2 rtl:ml-2"
                                        >
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Create Event
                                    </button>
                                    <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="isAddEventModal && '!block'">
                                        <div class="flex min-h-screen items-center justify-center px-4" @click.self="isAddEventModal = false">
                                            <div
                                                x-show="isAddEventModal"
                                                x-transition
                                                x-transition.duration.300
                                                class="panel my-8 w-[90%] max-w-lg overflow-hidden rounded-lg border-0 p-0 md:w-full"
                                            >
                                                <button
                                                    type="button"
                                                    class="absolute top-4 text-white-dark hover:text-dark ltr:right-4 rtl:left-4"
                                                    @click="isAddEventModal = false"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24px"
                                                        height="24px"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="h-6 w-6"
                                                    >
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg>
                                                </button>
                                                <h3
                                                    class="bg-[#fbfbfb] py-3 text-lg font-medium ltr:pl-5 ltr:pr-[50px] rtl:pr-5 rtl:pl-[50px] dark:bg-[#121c2c]"
                                                    x-text="params.id ? 'Edit Event' : 'Add Event'"
                                                ></h3>
                                                <div class="p-5">
                                                    <form @submit.prevent="saveEvent">
                                                        <div class="mb-5">
                                                            <label for="title">Event Title :</label>
                                                            <input
                                                                id="title"
                                                                type="text"
                                                                name="title"
                                                                id="title"
                                                                class="form-input"
                                                                placeholder="Enter Event Title"
                                                                x-model="params.title"
                                                                required
                                                            />
                                                            <div class="mt-2 text-danger" id="titleErr"></div>
                                                        </div>

                                                        <div class="mb-5">
                                                            <label for="dateStart">From :</label>
                                                            <input
                                                                id="dateStart"
                                                                type="datetime-local"
                                                                name="start"
                                                                id="start"
                                                                class="form-input"
                                                                placeholder="Event Start Date"
                                                                x-model="params.start"
                                                                :min="minStartDate"
                                                                @change="startDateChange($event)"
                                                                required
                                                            />
                                                            <div class="mt-2 text-danger" id="startDateErr"></div>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="dateEnd">To :</label>
                                                            <input
                                                                id="dateEnd"
                                                                type="datetime-local"
                                                                name="end"
                                                                id="end"
                                                                class="form-input"
                                                                placeholder="Event End Date"
                                                                x-model="params.end"
                                                                :min="minEndDate"
                                                                required
                                                            />
                                                            <div class="mt-2 text-danger" id="endDateErr"></div>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label for="description">Event Description :</label>
                                                            <textarea
                                                                id="description"
                                                                name="description"
                                                                id="description"
                                                                class="form-textarea min-h-[130px]"
                                                                placeholder="Enter Event Description"
                                                                x-model="params.description"
                                                            ></textarea>
                                                        </div>
                                                        <div class="mb-5">
                                                            <label>Badge:</label>
                                                            <div class="mt-3">
                                                                <label class="inline-flex cursor-pointer ltr:mr-3 rtl:ml-3">
                                                                    <input type="radio" class="form-radio" name="badge" value="primary" x-model="params.type" />
                                                                    <span class="ltr:pl-2 rtl:pr-2">Work</span>
                                                                </label>
                                                                <label class="inline-flex cursor-pointer ltr:mr-3 rtl:ml-3">
                                                                    <input
                                                                        type="radio"
                                                                        class="form-radio text-info"
                                                                        name="badge"
                                                                        value="info"
                                                                        x-model="params.type"
                                                                    />
                                                                    <span class="ltr:pl-2 rtl:pr-2">Travel</span>
                                                                </label>
                                                                <label class="inline-flex cursor-pointer ltr:mr-3 rtl:ml-3">
                                                                    <input
                                                                        type="radio"
                                                                        class="form-radio text-success"
                                                                        name="badge"
                                                                        value="success"
                                                                        x-model="params.type"
                                                                    />
                                                                    <span class="ltr:pl-2 rtl:pr-2">Personal</span>
                                                                </label>
                                                                <label class="inline-flex cursor-pointer">
                                                                    <input
                                                                        type="radio"
                                                                        class="form-radio text-danger"
                                                                        name="badge"
                                                                        value="danger"
                                                                        x-model="params.type"
                                                                    />
                                                                    <span class="ltr:pl-2 rtl:pr-2">Important</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mt-8 flex items-center justify-end">
                                                            <button type="button" class="btn btn-outline-danger" @click="isAddEventModal = false">
                                                                Cancel
                                                            </button>
                                                            <button
                                                                type="submit"
                                                                class="btn btn-primary ltr:ml-4 rtl:mr-4"
                                                                x-text="params.id ? 'Update Event' : 'Create Event'"
                                                            ></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="calendar-wrapper" id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end main content section -->

                </div>

                <!-- start footer section -->
                <div class="p-6 pt-0 mt-auto text-center dark:text-white-dark ltr:sm:text-left rtl:sm:text-right">
                    © <span id="footer-year">2022</span>. Vristo All rights reserved.
                </div>
                <!-- end footer section -->
            </div>
        </div>

        <script src="assets/js/alpine-collaspe.min.js"></script>
        <script src="assets/js/alpine-persist.min.js"></script>
        <script defer src="assets/js/alpine-ui.min.js"></script>
        <script defer src="assets/js/alpine-focus.min.js"></script>
        <script defer src="assets/js/alpine.min.js"></script>
        <script src="assets/js/fullcalendar.min.js"></script>
        <script src="assets/js/custom.js"></script>
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

                // theme customization
                Alpine.data('customizer', () => ({
                    showCustomizer: false,
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

                    notifications: [
                        {
                            id: 1,
                            profile: 'user-profile.jpeg',
                            message: '<strong class="text-sm mr-1">John Doe</strong>invite you to <strong>Prototyping</strong>',
                            time: '45 min ago',
                        },
                        {
                            id: 2,
                            profile: 'profile-34.jpeg',
                            message: '<strong class="text-sm mr-1">Adam Nolan</strong>mentioned you to <strong>UX Basics</strong>',
                            time: '9h Ago',
                        },
                        {
                            id: 3,
                            profile: 'profile-16.jpeg',
                            message: '<strong class="text-sm mr-1">Anna Morgan</strong>Upload a file',
                            time: '9h Ago',
                        },
                    ],

                    messages: [
                        {
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

                    languages: [
                        {
                            id: 1,
                            key: 'Chinese',
                            value: 'zh',
                        },
                        {
                            id: 2,
                            key: 'Danish',
                            value: 'da',
                        },
                        {
                            id: 3,
                            key: 'English',
                            value: 'en',
                        },
                        {
                            id: 4,
                            key: 'French',
                            value: 'fr',
                        },
                        {
                            id: 5,
                            key: 'German',
                            value: 'de',
                        },
                        {
                            id: 6,
                            key: 'Greek',
                            value: 'el',
                        },
                        {
                            id: 7,
                            key: 'Hungarian',
                            value: 'hu',
                        },
                        {
                            id: 8,
                            key: 'Italian',
                            value: 'it',
                        },
                        {
                            id: 9,
                            key: 'Japanese',
                            value: 'ja',
                        },
                        {
                            id: 10,
                            key: 'Polish',
                            value: 'pl',
                        },
                        {
                            id: 11,
                            key: 'Portuguese',
                            value: 'pt',
                        },
                        {
                            id: 12,
                            key: 'Russian',
                            value: 'ru',
                        },
                        {
                            id: 13,
                            key: 'Spanish',
                            value: 'es',
                        },
                        {
                            id: 14,
                            key: 'Swedish',
                            value: 'sv',
                        },
                        {
                            id: 15,
                            key: 'Turkish',
                            value: 'tr',
                        },
                        {
                            id: 16,
                            key: 'Arabic',
                            value: 'ae',
                        },
                    ],

                    removeNotification(value) {
                        this.notifications = this.notifications.filter((d) => d.id !== value);
                    },

                    removeMessage(value) {
                        this.messages = this.messages.filter((d) => d.id !== value);
                    },
                }));
                //calendar
                Alpine.data('calendar', () => ({
                    defaultParams: {
                        id: null,
                        title: '',
                        start: '',
                        end: '',
                        description: '',
                        type: 'primary',
                    },
                    params: {
                        id: null,
                        title: '',
                        start: '',
                        end: '',
                        description: '',
                        type: 'primary',
                    },
                    isAddEventModal: false,
                    minStartDate: '',
                    minEndDate: '',
                    calendar: null,
                    now: new Date(),
                    events: [],
                    init() {
                        this.events = [
                            {
                                id: 1,
                                title: 'All Day Event',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-01T14:30:00',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-02T14:30:00',
                                className: 'danger',
                                description:
                                    'Aenean fermentum quam vel sapien rutrum cursus. Vestibulum imperdiet finibus odio, nec tincidunt felis facilisis eu.',
                            },
                            {
                                id: 2,
                                title: 'Site Visit',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-07T19:30:00',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-08T14:30:00',
                                className: 'primary',
                                description: 'Etiam a odio eget enim aliquet laoreet. Vivamus auctor nunc ultrices varius lobortis.',
                            },
                            {
                                id: 3,
                                title: 'Product Lunching Event',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-17T14:30:00',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-18T14:30:00',
                                className: 'info',
                                description:
                                    'Proin et consectetur nibh. Mauris et mollis purus. Ut nec tincidunt lacus. Nam at rutrum justo, vitae egestas dolor.',
                            },
                            {
                                id: 4,
                                title: 'Meeting',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-12T10:30:00',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-13T10:30:00',
                                className: 'danger',
                                description: 'Mauris ut mauris aliquam, fringilla sapien et, dignissim nisl. Pellentesque ornare velit non mollis fringilla.',
                            },
                            {
                                id: 5,
                                title: 'Lunch',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-12T15:00:00',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-13T15:00:00',
                                className: 'info',
                                description: 'Integer fermentum bibendum elit in egestas. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
                            },
                            {
                                id: 6,
                                title: 'Conference',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-12T21:30:00',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-13T21:30:00',
                                className: 'success',
                                description:
                                    'Curabitur facilisis vel elit sed dapibus. Nunc sagittis ex nec ante facilisis, sed sodales purus rhoncus. Donec est sapien, porttitor et feugiat sed, eleifend quis sapien. Sed sit amet maximus dolor.',
                            },
                            {
                                id: 7,
                                title: 'Happy Hour',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-12T05:30:00',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-13T05:30:00',
                                className: 'info',
                                description:
                                    ' odio lectus, porttitor molestie scelerisque blandit, hendrerit sed ex. Aenean malesuada iaculis erat, vitae blandit nisl accumsan ut.',
                            },
                            {
                                id: 8,
                                title: 'Dinner',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-12T20:00:00',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-13T20:00:00',
                                className: 'danger',
                                description:
                                    'Sed purus urna, aliquam et pharetra ut, efficitur id mi. Pellentesque ut convallis velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                            },
                            {
                                id: 9,
                                title: 'Birthday Party',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-27T20:00:00',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now) + '-28T20:00:00',
                                className: 'success',
                                description:
                                    'Sed purus urna, aliquam et pharetra ut, efficitur id mi. Pellentesque ut convallis velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                            },
                            {
                                id: 10,
                                title: 'New Talent Event',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now, 1) + '-24T08:12:14',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now, 1) + '-27T22:20:20',
                                className: 'danger',
                                description:
                                    'Sed purus urna, aliquam et pharetra ut, efficitur id mi. Pellentesque ut convallis velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                            },
                            {
                                id: 11,
                                title: 'Other new',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now, -1) + '-13T08:12:14',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now, -1) + '-16T22:20:20',
                                className: 'primary',
                                description:
                                    'Pellentesque ut convallis velit. Sed purus urna, aliquam et pharetra ut, efficitur id mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                            },
                            {
                                id: 13,
                                title: 'Upcoming Event',
                                start: this.now.getFullYear() + '-' + this.getMonth(this.now, 1) + '-15T08:12:14',
                                end: this.now.getFullYear() + '-' + this.getMonth(this.now, 1) + '-18T22:20:20',
                                className: 'primary',
                                description:
                                    'Pellentesque ut convallis velit. Sed purus urna, aliquam et pharetra ut, efficitur id mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                            },
                        ];
                        var calendarEl = document.getElementById('calendar');
                        this.calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay',
                            },
                            editable: true,
                            dayMaxEvents: true,
                            selectable: true,
                            droppable: true,
                            eventClick: (event) => {
                                this.editEvent(event);
                            },
                            select: (event) => {
                                this.editDate(event);
                            },
                            events: this.events,
                        });
                        this.calendar.render();

                        this.$watch('$store.app.sidebar', () => {
                            setTimeout(() => {
                                this.calendar.render();
                            }, 300);
                        });
                    },

                    getMonth(dt, add = 0) {
                        let month = dt.getMonth() + 1 + add;
                        return dt.getMonth() < 10 ? '0' + month : month;
                    },

                    editEvent(data) {
                        this.params = JSON.parse(JSON.stringify(this.defaultParams));
                        if (data) {
                            let obj = JSON.parse(JSON.stringify(data.event));
                            this.params = {
                                id: obj.id ? obj.id : null,
                                title: obj.title ? obj.title : null,
                                start: this.dateFormat(obj.start),
                                end: this.dateFormat(obj.end),
                                type: obj.classNames ? obj.classNames[0] : 'primary',
                                description: obj.extendedProps ? obj.extendedProps.description : '',
                            };
                            this.minStartDate = new Date();
                            this.minEndDate = this.dateFormat(obj.start);
                        } else {
                            this.minStartDate = new Date();
                            this.minEndDate = new Date();
                        }

                        this.isAddEventModal = true;
                    },

                    editDate(data) {
                        let obj = {
                            event: {
                                start: data.start,
                                end: data.end,
                            },
                        };
                        this.editEvent(obj);
                    },

                    dateFormat(dt) {
                        dt = new Date(dt);
                        const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt.getMonth() + 1;
                        const date = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
                        const hours = dt.getHours() < 10 ? '0' + dt.getHours() : dt.getHours();
                        const mins = dt.getMinutes() < 10 ? '0' + dt.getMinutes() : dt.getMinutes();
                        dt = dt.getFullYear() + '-' + month + '-' + date + 'T' + hours + ':' + mins;
                        return dt;
                    },

                    saveEvent() {
                        if (!this.params.title) {
                            return true;
                        }
                        if (!this.params.start) {
                            return true;
                        }
                        if (!this.params.end) {
                            return true;
                        }

                        if (this.params.id) {
                            //update event
                            let event = this.events.find((d) => d.id == this.params.id);
                            event.title = this.params.title;
                            event.start = this.params.start;
                            event.end = this.params.end;
                            event.description = this.params.description;
                            event.className = this.params.type;
                        } else {
                            //add event
                            let maxEventId = 0;
                            if (this.events) {
                                maxEventId = this.events.reduce((max, character) => (character.id > max ? character.id : max), this.events[0].id);
                            }

                            let event = {
                                id: maxEventId + 1,
                                title: this.params.title,
                                start: this.params.start,
                                end: this.params.end,
                                description: this.params.description,
                                className: this.params.type,
                            };
                            this.events.push(event);
                        }
                        this.calendar.getEventSources()[0].refetch(); //refresh Calendar
                        this.showMessage('Event has been saved successfully.');
                        this.isAddEventModal = false;
                    },

                    startDateChange(event) {
                        const dateStr = event.target.value;
                        if (dateStr) {
                            this.minEndDate = this.dateFormat(dateStr);
                            this.params.end = '';
                        }
                    },

                    showMessage(msg = '', type = 'success') {
                        const toast = window.Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        toast.fire({
                            icon: type,
                            title: msg,
                            padding: '10px 20px',
                        });
                    },
                }));
            });
        </script>
    </body>
</html>
