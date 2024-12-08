document.addEventListener('DOMContentLoaded', function () {
    const editProfileLink = document.getElementById('edit-profile-link');
    const editProfileCard = document.getElementById('edit-profile-card');
    const editProfileForm = document.getElementById('edit-profile-form');
    const userEmail = 'user@example.com'; // Replace with the actual logged-in user's email

    editProfileLink.addEventListener('click', function (e) {
        e.preventDefault();
        fetchProfileData(userEmail);
        editProfileCard.style.display = 'block';
    });

    editProfileForm.addEventListener('submit', function (e) {
        e.preventDefault();
        saveProfileData(new FormData(editProfileForm));
    });

    function fetchProfileData(email) {
        fetch('fetch_profile.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                editProfileForm.first_name.value = data.user.first_name;
                editProfileForm.last_name.value = data.user.last_name;
                editProfileForm.email.value = data.user.email;
            } else {
                alert('Failed to fetch profile data');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function saveProfileData(formData) {
        fetch('save_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Profile updated successfully');
                editProfileCard.style.display = 'none';
            } else {
                alert('Failed to update profile');
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
