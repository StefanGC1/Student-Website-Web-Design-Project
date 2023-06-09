// Adding the forms for updating courses and grades dinamically

document.addEventListener('DOMContentLoaded', () => {
    const coursesForm = document.getElementById('courses-page');
    let innerCourseForm = courses_data.map(course => { // Map function
        return `<form action="update_course.php" method="POST" class="update-form">
        <h2 class="update-h2">Edit ${course.course_name}</h2>
        <input type="hidden" id="id" name="id" value="${course.id}">
            <label for="course-name">Course Name:</label>
            <input type="text" id="course-name" name="course-name" required value="${course.course_name}">
            <label for="course-desc">Course Description:</label>
            <textarea id="course-desc" name="course-desc" required>${course.description}</textarea>
            <label for="professor">Professor:</label>
            <input type="text" id="professor" name="professor" required value="${course.professor}">
            <label for="start-date">Start Date:</label>
            <input type="date" id="start-date" name="start-date" required value="${course.start_date}">
            <label for="end-date">End Date (Optional):</label>
            <input type="date" id="end-date" name="end-date" value="${course.end_date != null ? course.end_date : ""}">
            <input type="submit" value="Edit Course">
        </form>`;
    }).join("");

    coursesForm.innerHTML += innerCourseForm;

    const gradesFormAddSelect = document.getElementById('grade-course-name');
    let innerGradesFormAddSelect = course_name_data.map(courseName => {
        return `<option value="${courseName}">${courseName}</option>`
    }).join("");

    gradesFormAddSelect.innerHTML = innerGradesFormAddSelect;

    const gradesForm = document.getElementById("grades-page");
    let innerGradesForm = grades_data.map(gradeList => {
        return `<form action="update_grades.php" method="POST">
        <h2 class="update-h2">Edit ${gradeList.course_name} Grades</h2>
        <input type="hidden" id="id" name="id" value="${gradeList.id}">
        <label for="grades">Grades (separated by commas, no spaces):</label>
        <input type="text" id="grades" name="grades" required value="${gradeList.grades}">
        <input type="submit" value="Edit Grades">
        </form>`
    }).join("");

    gradesForm.innerHTML += innerGradesForm;
})