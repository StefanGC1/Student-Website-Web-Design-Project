

document.addEventListener('DOMContentLoaded', () => {
    const gradeList = document.getElementById('grade-list');

    const tableHtml = (csvString) => {
        let gradeList = csvString.split(',');
        const numCols = gradeList.length;

        return "<tr>" + gradeList.map(grade => { return `<td>${grade}</td>`;}).join("") + "</tr>";   
    }

    let innerGrades = data.map(courseGrades => {
        return `<div class="grade-item">
            <h2>${courseGrades.course_name}</h2>
            <table class="grade-table"><tbody>` +tableHtml(courseGrades.grades) +
            `</tbody></table>
        </div>`
    }).join("");

    gradeList.innerHTML = innerGrades;
});