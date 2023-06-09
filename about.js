const sections = ["Personal Information", "Education", "Work Experience", "Skills"];

const keys = ['personal_info', 'education', 'work_experience', 'skills'];

function dropDownMenuFunc(choice) {
    let result = document.getElementsByClassName("info-choice")[0];
    result.innerHTML = data[keys[choice]];
    result.classList.remove("info-choice-animation");
    void result.offsetWidth; // Trigger reflow to restart the animation
    result.classList.add("info-choice-animation")
    let buttonText = document.getElementsByClassName("drop-button")[0];
    buttonText.innerHTML = sections[choice];
}