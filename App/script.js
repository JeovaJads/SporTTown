function toggleMenu() {
    document.getElementById('menu').classList.toggle('active');
  }

  let index = 0;
  const carrossel = document.getElementById('carrossel');
  const totalSlides = carrossel.children.length;
  
  setInterval(() => {
    index = (index + 1) % totalSlides;
    carrossel.style.transform = `translateX(-${index * 100}%)`;
  }, 3000);