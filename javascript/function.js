// message timer

document.addEventListener("DOMContentLoaded", () => {
  const alert = document.getElementById("hello");
  setTimeout(() => {
    alert.style.display = 'none';
  }, 3000);
});

// active link

document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll(".nav-link");
  const currentPage = window.location.pathname;
  navLinks.forEach(link => {
    if (link.getAttribute("href") === currentPage.split('/').pop()) {
      link.classList.add("active");
    }
  });
});


// function myFunction() {
//   var element = document.getElementByclass(".nav-links");
//   element.classList.add("active");
// }
function myFunction() {
  var element = document.getElementById("abc");
  element.classList.add("active");
}

document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll(".nav-links");
  const currentPage = window.location.pathname;
  navLinks.forEach(link => {
    if (link.getAttribute("href") === currentPage.split('/').pop()) {
      link.classList.add("active");
    }
  });
});
// convert number into words 

function convertToWords(num, elementId) {

    if (num === 0) {
        document.getElementById(elementId).innerHTML = "Zero Only";
        return;
    }

    const ones = [
        "", "One", "Two", "Three", "Four", "Five", "Six",
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve",
        "Thirteen", "Fourteen", "Fifteen", "Sixteen",
        "Seventeen", "Eighteen", "Nineteen"
    ];

    const tens = [
        "", "", "Twenty", "Thirty", "Forty",
        "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"
    ];

    function getWords(n) {
        let str = "";

        if (n > 19) {
            str += tens[Math.floor(n / 10)] + " ";
            str += ones[n % 10];
        } else {
            str += ones[n];
        }

        return str.trim();
    }

    function convertBelowThousand(n) {
        let str = "";

        if (n >= 100) {
            str += ones[Math.floor(n / 100)] + " Hundred ";
            n = n % 100;
        }

        if (n > 0) {
            str += getWords(n) + " ";
        }

        return str.trim();
    }

    let result = "";

    let crore = Math.floor(num / 10000000);
    num %= 10000000;

    let lakh = Math.floor(num / 100000);
    num %= 100000;

    let thousand = Math.floor(num / 1000);
    num %= 1000;

    let hundred = num;

    if (crore) result += convertBelowThousand(crore) + " Crore ";
    if (lakh) result += convertBelowThousand(lakh) + " Lakh ";
    if (thousand) result += convertBelowThousand(thousand) + " Thousand ";
    if (hundred) result += convertBelowThousand(hundred);

    result = result.trim() + " Only";

    let el = document.getElementById(elementId);
    if (el) {
        el.innerHTML = result;
    }
}
// select all function
function toggleSelectAll(source) {
  const checkboxes = document.querySelectorAll('input[name="hobbies[]"]');
  checkboxes.forEach(checkbox => {
      checkbox.checked = source.checked;
  });
}
