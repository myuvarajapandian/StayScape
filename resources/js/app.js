import './bootstrap';

function addAmenityField() {
    const container = document.getElementById("amenities-container");
    const newAmenityField = document.createElement("div");
    newAmenityField.classList.add("mb-1");

    newAmenityField.innerHTML = `
        <label for="amenities">Amenities</label>
        <input type="text" class="form-control" name="amenities[]" required>
    `;

    container.appendChild(newAmenityField);
}
