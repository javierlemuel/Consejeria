"use strict"

const courseCategories = ["recomendadas", "concentracion", "generales", "humanidades", "ciencias Sociales",
    "electivas departamentales", "electivas libres"]

$(document).ready(() => {
    courseCategories.forEach((category, i) => {
            $("#coursesSection").append(
                `
                <div class="border border-[#d3d3d3] dark:border-[#1b2e4b] rounded">
                    <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === ${i+1}}" x-on:click="active === ${i+1} ? active = null : active = ${i+1}">
                     ${category.toUpperCase()}
                     </button>
                     <div x-cloak x-show="active === ${i+1}" x-collapse>
                        <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                            <ul class="space-y-1">
                                <li><a href="javascript:;">Lista de cursos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>`
            )
    });


});
