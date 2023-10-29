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
                    <ul
                            class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold"
                            x-data="{ activeDropdown: null }"
                        >
                            <li class="menu nav-item">
                                <button
                                    type="button"
                                    class="nav-link group"
                                    :class="{'active' : activeDropdown === 'students'}"
                                    @click="activeDropdown === 'students' ? activeDropdown = null : activeDropdown = 'students'"
                                >
                                    <div class="flex items-center">
                                    <svg
                                            class="shrink-0 group-hover:!text-primary"
                                            width="20"
                                            height="20"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <circle opacity="0.5" cx="15" cy="6" r="3" fill="currentColor" />
                                            <ellipse opacity="0.5" cx="16" cy="17" rx="5" ry="3" fill="currentColor" />
                                            <circle cx="9.00098" cy="6" r="4" fill="currentColor" />
                                            <ellipse cx="9.00098" cy="17.001" rx="7" ry="4" fill="currentColor" />
                                        </svg>

                                        <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Estudiantes</span>
                                    </div>
                                    <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'students'}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </button>
                                <ul x-cloak x-show="activeDropdown === 'students'" x-collapse class="sub-menu text-gray-500">
                                    <li>
                                        <a href="index.php">Lista</a>
                                    </li>
                                    <div x-data="app">
                                        <li>
                                            <a href="#" @click="openUploadModal">Subir csv</a>
                                        </li>
                                        <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="showUploadModal ? '!block' : ''">
                                            <div class="flex min-h-screen items-center justify-center px-4" @click.self="closeUploadModal">
                                                <div
                                                    x-show="showUploadModal"
                                                    x-transition
                                                    x-transition.duration.300
                                                    class="panel my-8 w-[90%] max-w-lg overflow-hidden rounded-lg border-0 p-0 md:w-full"
                                                >
                                                    <button
                                                        type="button"
                                                        class="absolute top-4 text-white-dark hover:text-dark ltr:right-4 rtl:left-4"
                                                        @click="closeUploadModal"
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
                                                    >
                                                        Subir Archivo CSV
                                                    </h3>
                                                    <div class="p-5">
                                                        <form @submit.prevent="submitForm">
                                                            <div>
                                                                <label for="csvfile">Subir el archivo .CSV con el formato requerido para añadir un estudiante.</label>
                                                                <input
                                                                    id="csvfile"
                                                                    type="file"
                                                                    class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary"
                                                                    required
                                                                />
                                                            </div>
                                                            <div class="mt-8 flex items-center justify-end">
                                                                <button type="button" class="btn btn-outline-danger" @click="closeUploadModal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">Subir</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li class="menu nav-item">
                                <button
                                    type="button"
                                    class="nav-link group"
                                    :class="{'active' : activeDropdown === 'cohort'}"
                                    @click="activeDropdown === 'students' ? activeDropdown = null : activeDropdown = 'cohort'"
                                >
                                    <div class="flex items-center">
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
                                                d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                                fill="currentColor"
                                            />
                                            <path
                                                d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z"
                                                fill="currentColor"
                                            />
                                        </svg>

                                        <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Cohortes</span>
                                    </div>
                                    <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'students'}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </button>
                                <ul x-cloak x-show="activeDropdown === 'cohort'" x-collapse class="sub-menu text-gray-500">
                                    <li>
                                        <a href="crear_cohorte.php">Crear</a>
                                    </li>
                                    <li>
                                        <a href="editar_cohorte.php">Editar</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu nav-item">
                                <button
                                    type="button"
                                    class="nav-link group"
                                    :class="{'active' : activeDropdown === 'classes'}"
                                    @click="activeDropdown === 'students' ? activeDropdown = null : activeDropdown = 'classes'"
                                >
                                    <div class="flex items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M20.082 3.01787L20.1081 3.76741L20.082 3.01787ZM16.5 3.48757L16.2849 2.76907V2.76907L16.5 3.48757ZM13.6738 4.80287L13.2982 4.15375L13.2982 4.15375L13.6738 4.80287ZM3.9824 3.07501L3.93639 3.8236L3.9824 3.07501ZM7 3.48757L7.19136 2.76239V2.76239L7 3.48757ZM10.2823 4.87558L9.93167 5.5386L10.2823 4.87558ZM13.6276 20.0694L13.9804 20.7312L13.6276 20.0694ZM17 18.6335L16.8086 17.9083H16.8086L17 18.6335ZM19.9851 18.2229L20.032 18.9715L19.9851 18.2229ZM10.3724 20.0694L10.0196 20.7312H10.0196L10.3724 20.0694ZM7 18.6335L7.19136 17.9083H7.19136L7 18.6335ZM4.01486 18.2229L3.96804 18.9715H3.96804L4.01486 18.2229ZM2.75 16.1437V4.99792H1.25V16.1437H2.75ZM22.75 16.1437V4.93332H21.25V16.1437H22.75ZM20.0559 2.26832C18.9175 2.30798 17.4296 2.42639 16.2849 2.76907L16.7151 4.20606C17.6643 3.92191 18.9892 3.80639 20.1081 3.76741L20.0559 2.26832ZM16.2849 2.76907C15.2899 3.06696 14.1706 3.6488 13.2982 4.15375L14.0495 5.452C14.9 4.95981 15.8949 4.45161 16.7151 4.20606L16.2849 2.76907ZM3.93639 3.8236C4.90238 3.88297 5.99643 3.99842 6.80864 4.21274L7.19136 2.76239C6.23055 2.50885 5.01517 2.38707 4.02841 2.32642L3.93639 3.8236ZM6.80864 4.21274C7.77076 4.46663 8.95486 5.02208 9.93167 5.5386L10.6328 4.21257C9.63736 3.68618 8.32766 3.06224 7.19136 2.76239L6.80864 4.21274ZM13.9804 20.7312C14.9714 20.2029 16.1988 19.6206 17.1914 19.3587L16.8086 17.9083C15.6383 18.2171 14.2827 18.8702 13.2748 19.4075L13.9804 20.7312ZM17.1914 19.3587C17.9943 19.1468 19.0732 19.0314 20.032 18.9715L19.9383 17.4744C18.9582 17.5357 17.7591 17.6575 16.8086 17.9083L17.1914 19.3587ZM10.7252 19.4075C9.71727 18.8702 8.3617 18.2171 7.19136 17.9083L6.80864 19.3587C7.8012 19.6206 9.0286 20.2029 10.0196 20.7312L10.7252 19.4075ZM7.19136 17.9083C6.24092 17.6575 5.04176 17.5357 4.06168 17.4744L3.96804 18.9715C4.9268 19.0314 6.00566 19.1468 6.80864 19.3587L7.19136 17.9083ZM21.25 16.1437C21.25 16.8295 20.6817 17.4279 19.9383 17.4744L20.032 18.9715C21.5062 18.8793 22.75 17.6799 22.75 16.1437H21.25ZM22.75 4.93332C22.75 3.47001 21.5847 2.21507 20.0559 2.26832L20.1081 3.76741C20.7229 3.746 21.25 4.25173 21.25 4.93332H22.75ZM1.25 16.1437C1.25 17.6799 2.49378 18.8793 3.96804 18.9715L4.06168 17.4744C3.31831 17.4279 2.75 16.8295 2.75 16.1437H1.25ZM13.2748 19.4075C12.4825 19.8299 11.5175 19.8299 10.7252 19.4075L10.0196 20.7312C11.2529 21.3886 12.7471 21.3886 13.9804 20.7312L13.2748 19.4075ZM13.2982 4.15375C12.4801 4.62721 11.4617 4.65083 10.6328 4.21257L9.93167 5.5386C11.2239 6.22189 12.791 6.18037 14.0495 5.452L13.2982 4.15375ZM2.75 4.99792C2.75 4.30074 3.30243 3.78463 3.93639 3.8236L4.02841 2.32642C2.47017 2.23065 1.25 3.49877 1.25 4.99792H2.75Z"
                                                    fill="currentColor"
                                                />
                                                <path opacity="0.5" d="M12 5.854V20.9999" stroke="currentColor" stroke-width="1.5" />
                                                <path opacity="0.5" d="M5 9L9 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path opacity="0.5" d="M5 13L9 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path opacity="0.5" d="M19 13L15 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path
                                                    d="M19 5.5V9.51029C19 9.78587 19 9.92366 18.9051 9.97935C18.8103 10.035 18.6806 9.97343 18.4211 9.85018L17.1789 9.26011C17.0911 9.21842 17.0472 9.19757 17 9.19757C16.9528 9.19757 16.9089 9.21842 16.8211 9.26011L15.5789 9.85018C15.3194 9.97343 15.1897 10.035 15.0949 9.97935C15 9.92366 15 9.78587 15 9.51029V6.95002"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                />
                                            </svg>

                                        <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Clases</span>
                                    </div>
                                    <div class="rtl:rotate-180" :class="{'!rotate-90' : activeDropdown === 'students'}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </button>
                                <ul x-cloak x-show="activeDropdown === 'classes'" x-collapse class="sub-menu text-gray-500">
                                    <li>
                                        <a href="clases.php">Ver clases</a>
                                    </li>
                                    <li>
                                        <a href="crear_clase.php">Crear clase</a>
                                    </li>
                                </ul>
                            </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end sidebar section -->
        <!-- end sidebar section -->

        <div class="main-content flex flex-col min-h-screen">
            <!-- start header section -->
            <header class="z-40" :class="{'dark' : $store.app.semidark && $store.app.menu === 'horizontal'}">
                <div class="shadow-sm">
                    <div class="relative flex w-full items-center bg-warning px-5 py-2.5 dark:bg-[#0e1726]">
                        <div class="horizontal-logo flex items-center justify-between ltr:mr-2 rtl:ml-2 lg:hidden">
                            <a href="index.php" class="main-logo flex shrink-0 items-center">
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
                <!-- start main content section -->
                <div x-data="contacts">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <h2 class="text-xl">Expedientes de Estudiantes</h2>
                            <!-- Comienzo Boton drop down -->
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" @click="toggle">Filtrar por Estatus
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 100 100">
                                        <text x="50" y="65" font-size="48" fill="White">▼</text>
                                    </svg>
                                </button>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 whitespace-nowrap">
                                    <li><a href="?status=Todos" @click="toggle">Todos</a></li>
                                    <li><a href="?status=Activos" @click="toggle">Activos</a></li>
                                    <li><a href="?status=Inactivos" @click="toggle">Inactivos</a></li>
                                </ul>
                            </div>
                            <!-- Final del boton de dropdown-->
                            <div class="flex w-full flex-col gap-4 sm:w-auto sm:flex-row sm:items-center sm:gap-3">
                                <div class="flex gap-3">
                                    <div>
                                        <button type="button" class="btn btn-primary" @click="editUser">
                                            <svg
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 ltr:mr-2 rtl:ml-2"
                                            >
                                                <circle cx="10" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                                <path
                                                    opacity="0.5"
                                                    d="M18 17.5C18 19.9853 18 22 10 22C2 22 2 19.9853 2 17.5C2 15.0147 5.58172 13 10 13C14.4183 13 18 15.0147 18 17.5Z"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                />
                                                <path
                                                    d="M21 10H19M19 10H17M19 10L19 8M19 10L19 12"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                />
                                            </svg>
                                            Crear estudiante
                                        </button>
                                        <div class="fixed inset-0 z-[999] hidden overflow-y-auto bg-[black]/60" :class="addContactModal && '!block'">
                                            <div class="flex min-h-screen items-center justify-center px-4" @click.self="addContactModal = false">
                                                <div
                                                    x-show="addContactModal"
                                                    x-transition
                                                    x-transition.duration.300
                                                    class="panel my-8 w-[90%] max-w-lg overflow-hidden rounded-lg border-0 p-0 md:w-full"
                                                >
                                                    <button
                                                        type="button"
                                                        class="absolute top-4 text-white-dark hover:text-dark ltr:right-4 rtl:left-4"
                                                        @click="addContactModal = false"
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
                                                        x-text="params.id ? 'Editar estudiante' : 'Crear estudiante'"
                                                    ></h3>
                                                    <div class="p-5">
                                                        <form @submit.prevent="saveUser" id="studentForm" action="#" method="POST">
                                                            <div class="mb-5 grid grid-cols-1 md:grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                                                <input type="hidden" name="action" value="addStudent">
                                                                <div>
                                                                    <label for="nombre">Nombre</label>
                                                                    <input x-model="params.nombre" id="nombre" name="nombre" type="text" class="form-input" maxlength="15" required/>
                                                                </div>
                                                                <div>
                                                                    <label for="nombre2">2do nombre</label>
                                                                    <input id="nombre2" name="nombre2" type="text" class="form-input" maxlength="15"/>
                                                                </div>
                                                                <div>
                                                                    <label for="apellidoP">Apellido P</label>
                                                                    <input x-model="params.apellidoP" id="apellidoP" name="apellidoP" type="text"class="form-input" maxlength="20" required/>
                                                                </div>
                                                                <div>
                                                                    <label for="apellidoM">Apellido M</label>
                                                                    <input id="apellidoM" name="apellidoM" type="text" class="form-input" maxlength="20"/>
                                                                </div>
                                                            </div>
                                                            <div class="mb-5">
                                                                <label for="email">Email</label>
                                                                <input
                                                                    id="email"
                                                                    name="email"
                                                                    type="email"
                                                                    placeholder="yeyo.soto2@upr.edu"
                                                                    class="form-input"
                                                                    x-model="params.email"
                                                                    required
                                                                />
                                                            </div>
                                                            <div class="mb-5">
                                                                <label for="minor">Minor</label>
                                                                <select id="gridYear" class="form-select text-white-dark" name="minor">
                                                                    <option value="0"></option>
                                                                    <option value="1">Web Design</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-5">
                                                                <label for="numero">Número de estudiante</label>
                                                                <input
                                                                    id="numero"
                                                                    name="numero_estu"
                                                                    type="text"
                                                                    placeholder="840-xx-xxxx"
                                                                    class="form-input"
                                                                    x-model="params.numero"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 9);"
                                                                    maxlength="9"
                                                                    required
                                                                />
                                                            </div>
                                                            <div class="mb-5">
                                                                <label for="cohorte">Cohorte</label>
                                                                <select id="gridYear" class="form-select text-white-dark" name="cohorte" x-model="params.cohorte" required>
                                                                    <option value="2017">2017</option>
                                                                    <option value="2022">2022</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-5">
                                                                <label for="estatus">Estatus</label>
                                                                <select id="status" x-model="params.estatus" class="form-select text-white-dark" name="estatus" required>
                                                                    <option>Activo</option>    
                                                                    <option>Inactivo</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-5">
                                                                <label for="birthday">Birthday</label>
                                                                <input type="date" x-model="params.birthday" id="birthday" name="birthday" required>               
                                                            </div>
                                                            
                                                            <div class="mt-8 flex items-center justify-end">
                                                                <button type="button" class="btn btn-outline-danger" @click="addContactModal = false">
                                                                    Cancelar
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" x-text="params.id ? 'Update' : 'Anadir'"></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative">
                                    <input
                                        type="text"
                                        placeholder="Buscar estudiante"
                                        class="peer form-input py-2 ltr:pr-11 rtl:pl-11"
                                        x-model="searchUser"
                                        @keyup="searchContacts"
                                    />
                                    <div class="absolute top-1/2 -translate-y-1/2 peer-focus:text-primary ltr:right-[11px] rtl:left-[11px]">
                                        <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5" opacity="0.5"></circle>
                                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div> <br>
                        <!-- inicio de tabla para presentar los estudiantes-->
                        <div class="table-responsive">
                            <table class="table-striped">
                                <thead>
                                    <tr>
                                        <th>Estudiante</th>
                                        <th>Numero de estudiante</th>
                                        <th>Consejeria</th>
                                        <th>Estatus</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($students as $student): ?>
                                        <tr>
                                            <td><?= $student['name1'] ?> <?= $student['name2'] ?> <?= $student['last_name1'] ?> <?= $student['last_name2'] ?></td>
                                            <td><?= $student['formatted_student_num'] ?></td>
                                            <td>
                                                <?php if ($student['conducted_counseling'] == 0): ?>
                                                    <span class="badge whitespace-nowrap badge-outline-danger">No realizada</span>
                                                <?php else: ?>
                                                    <span class="badge whitespace-nowrap badge-outline-primary">Realizada</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($student['status'] == 'Inactivo'): ?>
                                                    <span class="badge whitespace-nowrap badge-outline-danger">Inactivo</span>
                                                <?php else: ?>
                                                    <span class="badge whitespace-nowrap badge-outline-success">Activo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <form method="POST" action="#">
                                                    <input type="hidden" name="action" value="editStudent">
                                                    <input type="hidden" name="student_num" value="<?= $student['student_num'] ?>">
                                                    <button type="submit" class="btn btn-primary ltr:ml-2 rtl:mr-2" x-text="params.id ? 'Update' : 'Editar'"></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div> <br>
                        <!-- final de tabla para presentar los estudiantes-->
                        <!--inicio de paginacion -->
                        <div class="pagination">
                            <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto">
                                <li>
                                    <a href="?page=<?php echo $currentPage > 1 ? $currentPage - 1 : 1; ?>&status=<?php echo $statusFilter; ?>">
                                        <button type="button" class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover-bg-primary dark-text-white-light dark-bg-[#191e3a] dark-hover-bg-primary">
                                            <svg xmlns="http://w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                            </svg>
                                        </button>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li>
                                        <a href="?page=<?php echo $i; ?>&status=<?php echo $statusFilter; ?>">
                                            <button type="button" class="flex justify-center font-semibold px-3.5 py-2 rounded transition <?php echo ($i === $currentPage) ? 'bg-primary text-white' : 'bg-white-light text-dark hover-text-white hover-bg-primary dark-text-white-light dark-bg-[#191e3a] dark-hover-bg-primary'; ?>">
                                                <?php echo $i; ?>
                                            </button>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                                <li>
                                    <a href="?page=<?php echo $currentPage < $totalPages ? $currentPage + 1 : $totalPages; ?>&status=<?php echo $statusFilter; ?>">
                                        <button type="button" class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover-text-white hover-bg-primary dark-text-white-light dark-bg-[#191e3a] dark-hover-bg-primary">
                                            <svg xmlns="http://w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </button>
                                    </a>
                                </li>
                            </ul>
                        </div>
                         <!-- termina la paginacion UTILIZA SCRIPTS-->
        </div> <br>
            <!-- end main content section -->

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

        /*document.getElementById('studentForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Evita la recarga de la página por defecto al enviar el formulario

            // Obtiene los datos del formulario
            const formData = new FormData(this);

            // Realiza una solicitud HTTP POST para enviar los datos al controlador PHP
            fetch('expedientesController.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.text())
                .then(data => {
                    // Aquí puedes manejar la respuesta del servidor (si es necesario)
                    console.log(data);
                    // Por ejemplo, puedes cerrar el modal o mostrar un mensaje de éxito
                    addContactModal = false; // Cierra el modal
                })
                .catch(error => {
                    // Maneja cualquier error de la solicitud
                    console.error('Error:', error);
                });
        });*/

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

        // document.addEventListener("DOMContentLoaded", () => {
        //     //Necessary to check these buttons exist at moment of loading
        //     // hook up click events for both buttons
        //     //document.querySelector("#images/espresso_info.jpg").addEventListener("click", joinList("espresso"));
        //     //$("#clear_form").addEventListener("click", clearForm);
        //     document.querySelector(".elec").addEventListener("click") => {
        //         document.getElementById("elec").innerHTML = "";
        //     }

        //     // set focus on first text box after the form loads
        //     //$("#email_1").focus();
        // });
    </script>
    <!-- dropdown script -->
    <script>

        function changePage(page) {
            // Redirige a la página correspondiente
            window.location.href = "?page=" + page;
        }    

        document.addEventListener("alpine:init", () => {
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

            //contacts
            Alpine.data('contacts', () => ({
                    defaultParams: {
                        id: null,
                        nombre: '',
                        email: '',
                        minor: '',
                        numero: '',
                        cohorte: '',
                        birthday: '',
                    },
                    displayType: 'list',
                    addContactModal: false,
                    params: {
                        id: null,
                        nombre: '',
                        email: '',
                        minor: '',
                        numero: '',
                        cohorte: '',
                        birthday: '',
                    },
                    filterdContactsList: [],
                    searchUser: '',
                    contactList: [
                        {
                            id: 1,
                            path: 'profile-35.png',
                            nombre: 'Joel Melvin Ramos Soto',
                            email: 'joel.ramos4@upr.edu',
                            minor: 'Web Design',
                            consejeria: 'Realizada',
                            numero: '840-22-5677',
                            cohorte: 2022,
                            priority: 'activo',
                            birthday: '2013-09-12',
                        },
                        {
                            id: 2,
                            path: 'profile-35.png',
                            nombre: 'Melissa Diaz Gonzalez',
                            email: 'melissa.diaz10@upr.edu',
                            minor: '',
                            consejeria: 'No realizada',
                            numero: '840-23-1290',
                            cohorte: 2022,
                            priority: 'activo',
                            birthday: '2014-05-10',
                        },
                        {
                            id: 3,
                            path: 'profile-35.png',
                            nombre: 'Melvin Raúl Lopez Reyes',
                            email: 'melvin.lopez2@upr.edu',
                            minor: 'Web Design',
                            consejeria: 'Realizada',
                            numero: '840-22-2345',
                            cohorte: 2022,
                            priority: 'activo',
                            birthday: '2015-03-03',
                        },
                        {
                            id: 4,
                            path: 'profile-35.png',
                            nombre: 'Jean Deida Quinones',
                            email: 'jean.deida3@upr.edu',
                            minor: '',
                            consejeria: 'Realizada',
                            numero: '840-23-1256',
                            cohorte: 2022,
                            priority: 'activo',
                            birthday: '2004-09-12',
                        },
                        {
                            id: 5,
                            path: 'profile-35.png',
                            nombre: 'Natalia Marta Zapato Monterrey',
                            email: 'natalia.zapato@upr.du',
                            minor: 'Web Design',
                            consejeria: 'Realizada',
                            numero: '840-23-1278',
                            cohorte: 2022,
                            priority: 'activo',
                            birthday: '2006-04-12',
                        },
                    ],

                    init() {
                        this.searchContacts();
                    },

                    searchContacts() {
                        this.filterdContactsList = this.contactList.filter((d) => d.nombre.toLowerCase().includes(this.searchUser.toLowerCase()));
                    },

                    editUser(user) {
                        this.params = this.defaultParams;
                        if (user) {
                            this.params = JSON.parse(JSON.stringify(user));
                        }

                        this.addContactModal = true;
                    },

                    saveUser() {
                        if (!this.params.nombre) {
                            this.showMessage('Name is required.', 'error');
                            return true;
                        }
                        if (!this.params.email) {
                            this.showMessage('Email is required.', 'error');
                            return true;
                        }
                        if (!this.params.numero) {
                            this.showMessage('Number is required.', 'error');
                            return true;
                        }

                        if (this.params.id) {
                            //update user
                            let user = this.contactList.find((d) => d.id === this.params.id);
                            user.nombre = this.params.nombre,
                            user.nombre2 = this.params.nombre2,
                            user.apellidoP = this.params.apellidoP,
                            user.apellidoM = this.params.apellidoM,
                            user.email = this.params.email;
                            user.minor = this.params.minor;
                            user.numero = this.params.numero;
                            user.cohorte = this.params.cohorte;
                            user.consejeria = 'No realizada';
                            user.priority = 'activo';
                            user.birthday =  this.params.birthday;
                        } else {
                            //add user
                            let maxUserId = this.contactList.length
                                ? this.contactList.reduce((max, character) => (character.id > max ? character.id : max), this.contactList[0].id)
                                : 0;

                            let user = {
                                id: maxUserId + 1,
                                path: 'profile-35.png',
                                nombre: this.params.nombre,
                                nombre2: this.params.nombre2,
                                apellidoP: this.params.apellidoP,
                                apellidoM: this.params.apellidoM,
                                email: this.params.email,
                                minor: this.params.minor,
                                numero: this.params.numero,
                                cohorte: this.params.cohorte,
                                consejeria: 'No realizada',
                                priority: 'activo',
                                birthday: this.params.birthday,
                            };
                            this.contactList.splice(0, 0, user);
                            this.searchContacts();
                        }

                        this.showMessage('User has been saved successfully.');
                        this.addContactModal = false;
                    },

                    deleteUser(user) {
                        this.contactList = this.contactList.filter((d) => d.id != user.id);
                        // this.ids = this.ids.filter((d) => d != user.id);
                        this.searchContacts();
                        this.showMessage('User has been deleted successfully.');
                    },

                    setDisplayType(type) {
                        this.displayType = type;
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

                    tabChanged(type) {
                        this.selectedTab = type;
                        this.searchContacts();
                        this.isShowTaskMenu = false;
                    },

                    setPriority(contact, nombre) {
                        let item = this.filterdContactsList.find((d) => d.id === contact.id);
                        item.priority = nombre;
                        this.searchContacts(false);
                    },
                }));
            });
            
            // window.addEventListener('alpine:init', () => {
                
            // });
 
    </script>
</body>

</html>