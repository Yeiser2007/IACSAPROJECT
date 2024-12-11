
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-item');
const totalSlides = slides.length;

document.querySelector('.next').addEventListener('click', () => {
    changeSlide(1);
});

document.querySelector('.prev').addEventListener('click', () => {
    changeSlide(-1);
});

function changeSlide(direction) {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
    slides[currentSlide].classList.add('active');
}


const days = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
const hours = [
    "Cerrado",
    "9:00 AM - 5:00 PM",
    "9:00 AM - 5:00 PM",
    "9:00 AM - 5:00 PM",
    "9:00 AM - 5:00 PM",
    "9:00 AM - 5:00 PM",
    "10:00 AM - 2:00 PM"
];
const today = new Date().getDay();
document.getElementById('today-schedule').textContent = `${days[today]}: ${hours[today]}`;


document.getElementById('toggle-hours').addEventListener('click', () => {
    const workHoursList = document.getElementById('work-hours-list');
    workHoursList.classList.toggle('hidden');
});


const fadeInElements = document.querySelectorAll('.fade-in');

const isInViewport = (element) => {
    const rect = element.getBoundingClientRect();
    return rect.top <= window.innerHeight && rect.bottom >= 0;
};

const handleScroll = () => {
    fadeInElements.forEach((element) => {
        if (isInViewport(element)) {
            element.classList.add('visible');
        }
    });
};
document.getElementById('show-form-btn').addEventListener('click', function() {
    document.getElementById('contact-info').classList.add('hidden');
    document.getElementById('contact-form').classList.remove('hidden');
});

document.getElementById('close-form-btn').addEventListener('click', function() {
    document.getElementById('contact-form').classList.add('hidden');
    document.getElementById('contact-info').classList.remove('hidden');
});

window.addEventListener('scroll', handleScroll);
window.addEventListener('load', handleScroll);  
