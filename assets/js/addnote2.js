document.getElementById("addIcon").addEventListener("click", function() {
    document.getElementById("fileInput").click();
});

const fileInput = document.getElementById('fileInput');
const filePreviewContainer = document.getElementById('filePreviewContainer');
const fileName = document.getElementById('fileName');
const removeFile = document.getElementById('removeFile');
const docCount = document.getElementById('docCount');
let documentCounter = 0; // Counter for files

fileInput.addEventListener('change', function() {
    Array.from(fileInput.files).forEach(file => {
        handleFileSelection(file);
    });
});

function handleFileSelection(file) {
    const fileType = file.type;
    const reader = new FileReader();
    const previewElement = document.createElement('div');
    previewElement.style.marginTop = "10px";

    if (fileType.startsWith("image/")) {
        reader.onload = function(e) {
            previewElement.innerHTML = `<img src="${e.target.result}" class="file-preview" style="max-width: 100%; height: auto;">`;
        };
        reader.readAsDataURL(file);
    } else {
        previewElement.innerHTML = `<p class="file-name">📄 ${file.name}</p>`;
    }

    filePreviewContainer.appendChild(previewElement);
    fileName.textContent = file.name;
    removeFile.style.display = "block";

    documentCounter++;
    docCount.textContent = documentCounter;
}

// Remove all uploaded files when clicking the trash icon
removeFile.addEventListener('click', function() {
    filePreviewContainer.innerHTML = "";
    fileName.textContent = "";
    removeFile.style.display = "none";
    documentCounter = 0;
    docCount.textContent = documentCounter;
});

// Form Validation
document.getElementById('uploadForm').addEventListener('submit', function(event) {
    const category = document.getElementById('category').value;
    const module = document.getElementById('module').value;
    const docType = document.getElementById('docType').value;
    const language = document.getElementById('language').value;
    const description = document.getElementById('description').value;
    const files = fileInput.files;

    if (!category || !module || !docType || !language || !description || files.length === 0) {
        alert('Please fill out all fields and select at least one file.');
        event.preventDefault(); // Prevent form submission
    }
});

//fetching category and modules
document.addEventListener("DOMContentLoaded", function () {
    fetchCategories();

    document.getElementById("category").addEventListener("change", function () {
        fetchModules(this.value);
    });
});

function fetchCategories() {
    fetch("../api/auth/fetch_data.php?action=getCategories")
        .then(response => response.json())
        .then(data => {
            let categoryDropdown = document.getElementById("category");
            categoryDropdown.innerHTML = '<option value="">Select a category</option>';
            data.forEach(category => {
                categoryDropdown.innerHTML += `<option value="${category.id}">${category.name}</option>`;
            });
        })
        .catch(error => console.error("Error fetching categories:", error));
}

function fetchModules(categoryId) {
    console.log("Fetching modules for categoryId:", categoryId); // Debugging

    fetch(`../api/auth/fetch_data.php?action=getModules&categoryId=${categoryId}`)
        .then(response => response.json())
        .then(data => {
            console.log("Modules Response:", data); // Debugging

            let moduleDropdown = document.getElementById("module");
            moduleDropdown.innerHTML = '<option value="">Select a module name</option>';

            if (data.error) {
                console.error("Error fetching modules:", data.error);
                return;
            }

            data.forEach(module => {
                moduleDropdown.innerHTML += `<option value="${module.id}">${module.name}</option>`;
            });
        })
        .catch(error => console.error("Error fetching modules:", error));
}


document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    let formData = new FormData();
    formData.append("title", document.getElementById("title").value);
    formData.append("description", document.getElementById("description").value);
    formData.append("language", document.getElementById("language").value);
    formData.append("docType", document.getElementById("docType").value);
    formData.append("moduleId", document.getElementById("module").value);
    formData.append("file", document.getElementById("fileInput").files[0]);

    fetch("../api/auth/addfile.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("File uploaded successfully! XP increased by 10.");
            setTimeout(() => {
                window.location.href = "addnote3.php";
            },0);
        } else {
            alert("Upload failed: " + data.error);
        }
    })
    .catch(error => console.error("Error:", error));
});