//****************************** FONCTION DU COMPTEUR DE VISITES ****************************** */
// Counter function
function countVisitor() {
    let count = localStorage.getItem('visitorCount');
    count = count ? parseInt(count) + 1 : 1;
    localStorage.setItem('visitorCount', count);
    return count;
  }
  
  // Update visitor count in the footer
  const visitorCount = document.querySelector('#visitor-count');
  visitorCount.innerHTML = `You are the ${countVisitor()} visitor this month!`;




