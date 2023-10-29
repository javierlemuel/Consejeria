$(document).ready(()=>{
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const selectedCoursesDiv = document.getElementById('selected-courses');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Clear the selected courses div
                selectedCoursesDiv.innerHTML = '';

                // Get all checked checkboxes
                const checkedCheckboxes = [...checkboxes].filter(checkbox => checkbox.checked);

                // Display the selected courses in a table format
                if (checkedCheckboxes.length > 0) {
                    selectedCoursesDiv.innerHTML = "<table><thead><tr><th>Selected Courses</th></tr></thead><tbody>";
                    checkedCheckboxes.forEach(checkbox => {
                        const courseName = document.querySelector(`td input[value="${checkbox.value}"]`).parentNode.previousElementSibling.textContent;
                        selectedCoursesDiv.innerHTML += `<tr><td>${courseName}</td></tr>`;
                    });
                    selectedCoursesDiv.innerHTML += "</tbody></table>";
                }
            });
        });
})