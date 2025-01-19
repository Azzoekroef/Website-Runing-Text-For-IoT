<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Mode Texts Configuration</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 600px;
        margin: auto;
        padding: 20px;
    }
    h1 {
        color: #333;
    }
    .mode {
        padding: 15px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    label {
        display: block;
        margin: 10px 0 6px;
        font-weight: bold;
    }
    input[type="text"], input[type="number"], select {
        width: calc(100% - 20px); /* Adjust width to prevent overflow */
        padding: 8px;
        margin-top: 4px;
        box-sizing: border-box; /* Ensures padding doesn’t affect total width */
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    button {
        padding: 10px 15px;
        margin-top: 10px;
        border: none;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
    #currentModes {
        margin-top: 20px;
    }
    .no-scroll {
    overflow: hidden;
    }
</style>

    </style>
</head>
<body>
    <h1>Configure Display Modes</h1>
    <form id="ModeTextForm">
        <div id="modetextContainer">
            <!-- Mode inputs will be dynamically added here -->
        </div>
        <button type="button" onclick="addMode()">Add Mode</button>
        <button type="submit">Save</button>
        <button type="button" onclick="removeLastMode()">Remove Mode</button>
    </form>

    <div id="currentModes">
        <h2>Current Display Modes</h2>
        <ul id="modeList">
            <!-- Current mode configurations will be displayed here -->
        </ul>
    </div>

    <script>
        let modeCount = 0;

        function addMode() {
            modeCount++;
            const container = document.getElementById('modetextContainer');
            const modeHtml = `
                <div class="mode" id="mode-${modeCount}">
                    <h3>Mode ${modeCount}</h3>
                    <label>Text1: <input type="text" name="modes1[${modeCount}][text1]" required></label>
                    <label>Text2: <input type="text" name="modes2[${modeCount}][text2]" class="conditional-${modeCount}"></label>
                    <label>Mode: 
                        <select name="modes[${modeCount}][mode]" required onchange="toggleFields(${modeCount})">
                            <option value="1">Full Text</option>
                            <option value="2">Two-Line Text</option>
                            <option value="3">Half Time, Half Text</option>
                        </select>
                    </label>
                    <label>Delay1 (ms): <input type="number" name="modes1[${modeCount}][delay1]" required></label>
                    <label>Delay2 (ms): <input type="number" name="modes2[${modeCount}][delay2]" class="conditional-${modeCount}"></label>
                    <label>Direction1: 
                        <select name="modes1[${modeCount}][direction1]" required>
                            <option value="4">No Scroll</option>
                            <option value="0">Left to Right</option>
                            <option value="1">Right to Left</option>
                        </select>
                    </label>
                    <label>Direction2: 
                        <select name="modes2[${modeCount}][direction2]" class="conditional-${modeCount}">
                            <option value="4">No Scroll</option>
                            <option value="0">Left to Right</option>
                            <option value="1">Right to Left</option>
                        </select>
                    </label>
                    <hr>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', modeHtml);
            toggleFields(modeCount); // Initialize with the correct visibility
        }

        function toggleFields(count) {
            const modeSelect = document.querySelector(`select[name="modes[${count}][mode]"]`);
            const directionSelect1 = document.querySelector(`select[name="modes1[${count}][direction1]"]`);
            const directionSelect2 = document.querySelector(`select[name="modes2[${count}][direction2]"]`);
            const isFullText = modeSelect.value === "1";  // Full Text mode
            const clockFullText = modeSelect.value === "3";
            // Menyembunyikan atau menampilkan elemen berdasarkan mode
            const conditionalFields = document.querySelectorAll(`.conditional-${count}`);
            conditionalFields.forEach(field => {
                field.closest('label').style.display = (isFullText || clockFullText) ? 'none' : 'block';
            });
        
            // Menyembunyikan opsi tertentu pada Direction2 untuk Full Text
            const options1 = directionSelect1.querySelectorAll('option');
            const options2 = directionSelect2.querySelectorAll('option');
        
            // Menyembunyikan opsi untuk "Top to Bottom" dan "Bottom to Top"
            [options1, options2].forEach(options => {
                options.forEach(option => {
                    if ((isFullText || clockFullText) && (option.value === "2" || option.value === "3")) {
                        option.style.display = "none";  // Sembunyikan opsi "Top to Bottom" dan "Bottom to Top"
                    } else {
                        option.style.display = "block";  // Tampilkan kembali opsi
                    }
                    
                });
            });
        }


        document.getElementById('ModeTextForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = { modes: [] };

            for (let i = 1; i <= modeCount; i++) {
                const text1 = formData.get(`modes1[${i}][text1]`);
                const text2 = formData.get(`modes2[${i}][text2]`);
                const mode = parseInt(formData.get(`modes[${i}][mode]`));
                const delay1 = parseInt(formData.get(`modes1[${i}][delay1]`));
                const delay2 = parseInt(formData.get(`modes2[${i}][delay2]`));
                const direction1 = parseInt(formData.get(`modes1[${i}][direction1]`));
                const direction2 = parseInt(formData.get(`modes2[${i}][direction2]`));
                data.modes.push({ text1, text2, mode, delay1, delay2, direction1, direction2 });
            }

            const response = await fetch('api/mode', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            alert(result.message);

            // Update the display with the current modes
        });
        function removeLastMode() {
            if (modeCount > 0) {
                const lastMode = document.getElementById(`mode-${modeCount}`);
                lastMode.remove(); // Hapus elemen terakhir
                modeCount--; // Kurangi jumlah mode
            } else {
                alert('No modes to remove.');
            }
        }
        document.addEventListener('DOMContentLoaded', async function () {
            // Fetch data from server
            const response = await fetch('api/mode');
            const result = await response.json();
            // console.log(result.modes)
                
            result.modes.forEach((mode, index) => {
                modeCount++;
                const container = document.getElementById('modetextContainer');
                const modeHtml = `
                    <div class="mode" id="mode-${modeCount}">
                        <h3>Mode ${modeCount}</h3>
                        <label>Text1: <input type="text" name="modes1[${modeCount}][text1]" value="${mode.text1}" required></label>
                        <label>Text2: <input type="text" name="modes2[${modeCount}][text2]" value="${mode.text2}" class="conditional-${modeCount}"></label>
                        <label>Mode: 
                            <select name="modes[${modeCount}][mode]" required onchange="toggleFields(${modeCount})">
                                <option value="1" ${mode.mode === 1 ? 'selected' : ''}>Full Text</option>
                                <option value="2" ${mode.mode === 2 ? 'selected' : ''}>Two-Line Text</option>
                                <option value="3" ${mode.mode === 3 ? 'selected' : ''}>Half Time, Half Text</option>
                            </select>
                        </label>
                        <label>Delay1 (ms): <input type="number" name="modes1[${modeCount}][delay1]" value="${mode.delay1}" required></label>
                        <label>Delay2 (ms): <input type="number" name="modes2[${modeCount}][delay2]" value="${mode.delay2}" class="conditional-${modeCount}"></label>
                        <label>Direction1: 
                            <select name="modes1[${modeCount}][direction1]" required>
                                <option value="4" ${mode.direction1 === 4 ? 'selected' : ''}>No Scroll</option>
                                <option value="0" ${mode.direction1 === 0 ? 'selected' : ''}>Left to Right</option>
                                <option value="1" ${mode.direction1 === 1 ? 'selected' : ''}>Right to Left</option>
                            </select>
                        </label>
                        <label>Direction2: 
                            <select name="modes2[${modeCount}][direction2]" class="conditional-${modeCount}">
                                <option value="4" ${mode.direction2 === 4 ? 'selected' : ''}>No Scroll</option>
                                <option value="0" ${mode.direction2 === 0 ? 'selected' : ''}>Left to Right</option>
                                <option value="1" ${mode.direction2 === 1 ? 'selected' : ''}>Right to Left</option>
                            </select>
                        </label>
                        <button type="button" onclick="editMode(${modeCount})">Edit</button>
                        <button type="button" onclick="deleteMode(${modeCount})">Delete</button>
                        <hr>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', modeHtml);
                toggleFields(modeCount); // Initialize visibility for the fields
            });
        });
    </script>
</body>
</html>
