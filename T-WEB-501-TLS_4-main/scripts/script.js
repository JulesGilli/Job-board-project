document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll('.fade-in-section');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    });

    sections.forEach(section => {
        observer.observe(section);
    });
});
/* quand on appuis */
function toggleDescription(button) {
    var jobCard = button.closest('.job-card');
    var descriptionContainer = jobCard.querySelector('.job-description');
    var fullText = descriptionContainer.getAttribute('data-fulltext');
    var truncatedText = truncateText(fullText, 20);
    var hiddenTitle = jobCard.querySelector('.hidden-title');
    var applySection = jobCard.querySelector('.hidden-description-test');
    var applyShow = jobCard.querySelector('.hidden-show');

    if (button.textContent === "Show more") {
        descriptionContainer.textContent = fullText;
        hiddenTitle.style.display = "block";
        applySection.style.display = "block";
        applyShow.style.display = "none";
    } else if (button.textContent === "Show less") {
        descriptionContainer.textContent = truncatedText;
        hiddenTitle.style.display = "none";
        applySection.style.display = "none";
        applyShow.style.display = "block";
    }
}

function truncateText(text, wordLimit) {
    var words = text.split(' ');
    if (words.length > wordLimit) {
        return words.slice(0, wordLimit).join(' ') + '...';
    }
    return text;
}
/* au chargement */
document.addEventListener('DOMContentLoaded', function() {
    var jobCards = document.querySelectorAll('.job-card .job-description');
    const jobTitleInput = document.getElementById('jobTitle');
    const hiddenJobTitleInput = document.getElementById('hiddenJobTitle');
    const jobLocation = document.getElementById('jobLocation');
    const hiddenJobLocation = document.getElementById('hiddenLocation');

    jobCards.forEach(function(jobDescription) {
        var fullText = jobDescription.textContent;

        jobDescription.setAttribute('data-fulltext', fullText);

        var truncatedText = truncateText(fullText, 20);
        jobDescription.textContent = truncatedText;
    });

    jobTitleInput.addEventListener('input', function() {
        hiddenJobTitleInput.value = jobTitleInput.value;
    });

    jobLocation.addEventListener('input', function() {
        hiddenJobLocation.value = jobLocation.value;
    });
});

document.getElementById('password').addEventListener('input', function() {
    const passwordInput = this.value;
    const messageElement = document.getElementById('message');

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$€%^&*()_\-+=])[A-Za-z\d!@#$€%^&*()_\-+=]{12,}$/;

    if (passwordRegex.test(passwordInput)) {
        messageElement.textContent = "Valid password";
        messageElement.style.color = "green"; 
        messageElement.className = "valid"; 
    } else {
        messageElement.textContent = "Invalid password (at least 12 characters, one uppercase, one lowercase, one number and one special character)";
        messageElement.style.color = "red";  
        messageElement.className = "invalid";
    }

});

function passwordCheck() {
    var password = document.getElementById('password').value;

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$€%^&*()_\-+=])[A-Za-z\d!@#$€%^&*()_\-+=]{12,}$/;

    if (passwordRegex.test(password)) {
        return true; 
    } else {
        return false;
    }
}


function clearFormFilter() {
    var companySize = document.getElementById("companySize");
    var jobType = document.getElementById("jobTypeID");
    var contract = document.getElementById("contract");
    var sector = document.getElementById("sectorID");

    companySize.setAttribute("selected", "");
    jobType.setAttribute("selected", "");
    contract.setAttribute("selected", "");
    sector.setAttribute("selected", "");
}




