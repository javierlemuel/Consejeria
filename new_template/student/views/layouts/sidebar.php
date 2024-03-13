<!-- start sidebar section -->
<div :class="{'dark text-white-dark' : $store.app.semidark}">
    <nav x-data="sidebar" class="sidebar fixed top-0 bottom-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300">
        <div class="h-full bg-white dark:bg-[#0e1726]">
            <div class="flex items-center justify-between px-4 py-3">
                <a href="index.php?page=counseling" class="main-logo flex shrink-0 items-center">
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

                <a onclick="showinfo()" style="cursor:pointer">
                    <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                        <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                        </svg>
                        <span><?php echo $_SESSION['full_student_name'] ?></span>
                    </h2>
                </a>

                <div id="info" onclick="hideinfo()" style="display:none; cursor:pointer">
                    <h3 style="font-size: 12px;" class="-mx-4 mb-1 flex items-center py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                        <span><?php echo $_SESSION['formatted_student_num'] ?></span>
                    </h3>

                    <h3 style="font-size: 12px;" class="-mx-4 mb-2 flex items-center py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]" style="text-size: 14px;">
                        <?php echo $_SESSION['email'] ?>
                    </h3>

                </div>
                <form method="post" id="counseling_form" action="controllers/counselingController.php" class="mh-100">

                    <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                        <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                        </svg>
                        <span>Concentracion</span>
                    </h2>
                    <ul id="concentracion"></ul>
                    <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                        <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                        </svg>
                        <span>Generales</span>
                    </h2>
                    <ul id="generales"></ul>
                    <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                        <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                        </svg>
                        <span>Humanidades</span>
                    </h2>
                    <ul id="humanidades"></ul>
                    <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold  dark:bg-dark dark:bg-opacity-[0.08]">
                        <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <!-- <line x1="5" y1="12" x2="19" y2="12"></line> -->
                        </svg>
                        <span>Ciencias Sociales</span>
                    </h2>
                    <ul id="cienciasSociales"></ul>

                    <?php
                    //if the student conducted the counseling the button will be disable
                    echo $_SESSION['counseling_button'];

                    ?>

                </form>

            </ul>
        </div>
    </nav>
</div>
<!-- end sidebar section -->