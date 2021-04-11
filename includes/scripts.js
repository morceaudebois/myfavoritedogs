id = name => document.getElementById(name);
cl = name => document.getElementsByClassName(name);
all = name => document.querySelectorAll(name);
const baseURL = window.location.origin+window.location.pathname;
const list = id('items');





function addScreenWidthClasses() {
  if (window.innerWidth < 489) {
      document.body.classList.remove('mobile', 'smallTablet', 'tablet', 'desktop');
      document.body.classList.add('mobile');
  } else if (window.innerWidth < 768)  {
      document.body.classList.remove('mobile', 'smallTablet', 'tablet', 'desktop');
      document.body.classList.add('smallTablet');
  } else if (window.innerWidth < 992) {
      document.body.classList.remove('mobile', 'smallTablet', 'tablet', 'desktop');
      document.body.classList.add('tablet');
  } else {
      document.body.classList.remove('mobile', 'smallTablet', 'tablet', 'desktop');
      document.body.classList.add('desktop');
  }
}
window.addEventListener('resize', addScreenWidthClasses);







