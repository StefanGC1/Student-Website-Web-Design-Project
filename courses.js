// Adding the courses dinamically

document.addEventListener('DOMContentLoaded', () => {
    const course_list = document.getElementById('course-list');
    let innerCourses = data.map(course => {
        return `<div class="course-item">
            <h2>${course.course_name}</h2>
            <p class="course-description">Description: ${course.description}</p>
            <div class="course-add-info">
            <p>Professor: ${course.professor}</p>
            <p>Start Date: ${course.start_date}</p>
            <p>End Date: ${course.end_date != null ? course.end_date : "Ongoing"}</p>
            </div>
        </div>`;
    }).join('');

    course_list.innerHTML= innerCourses;
});