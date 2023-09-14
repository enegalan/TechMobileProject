const items = document.querySelectorAll('.accordion button');

function toggleAccordion() {
    const itemToggle = this.getAttribute('aria-expanded');
    for (let i = 0; i < items.length; i++) {
        items[i].setAttribute('aria-expanded', 'false');
    }
    if (itemToggle === 'false') {
        this.setAttribute('aria-expanded', 'true');
    }
}

items.forEach((item) => item.addEventListener('click', function(event){
    event.preventDefault(); // Evita la recarga de página 
    toggleAccordion.call(this); // Pasa el elemento actual al método para que sepa qué elemento se hizo clic
}));