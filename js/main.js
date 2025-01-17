 // Add active class to nav items on scroll
 document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').includes(current)) {
                link.classList.add('active');
            }
        });
    });
});

document.getElementById('applyForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    // Collect form data
    const formData = new FormData(this);

    // Send form data to backend
    fetch('send-email.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Application sent successfully!');
          // Close the modal
          document.querySelector('#applyModal .btn-close').click();
        } else {
          alert('Failed to send application. Please try again.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
      });
  });


    document.getElementById('contactForm').addEventListener('submit', function (event) {
        // Prevent default form submission
        event.preventDefault();

        // Collect form data
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const department = document.getElementById('department').value;
        const message = document.getElementById('message').value.trim();
        const errorDiv = document.getElementById('formError');

        // Validate form fields
        if (!name) {
            errorDiv.textContent = "Please enter your name.";
            errorDiv.style.display = "block";
            return;
        }

        if (!email || !validateEmail(email)) {
            errorDiv.textContent = "Please enter a valid email address.";
            errorDiv.style.display = "block";
            return;
        }

        if (!department) {
            errorDiv.textContent = "Please select a department.";
            errorDiv.style.display = "block";
            return;
        }

        if (!message) {
            errorDiv.textContent = "Please enter your message.";
            errorDiv.style.display = "block";
            return;
        }

        // Hide error message if validation is successful
        errorDiv.style.display = "none";

        // Submit form if validation passes
        this.submit();
    });

    // Function to validate email format
    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
