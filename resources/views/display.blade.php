<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Modes Configuration</title>
</head>
<body>
    <h1>Configure Display Modes</h1>
    <form id="displayModesForm">
        <div id="modesContainer">
            <!-- Mode inputs will be dynamically added here -->
        </div>
        <button type="button" onclick="addMode()">Add Mode</button>
        <button type="submit">Save</button>
    </form>

    <script>
        let modeCount = 0;

        function addMode() {
            modeCount++;
            const container = document.getElementById('modesContainer');
            const modeHtml = `
                <div class="mode">
                    <h3>Mode ${modeCount}</h3>
                    <label>Text: <input type="text" name="modes[${modeCount}][text]" required></label><br>
                    <label>Mode: 
                        <select name="modes[${modeCount}][mode]" required>
                            <option value="1">Full Text</option>
                            <option value="2">Two-line Text</option>
                            <option value="3">Half Clock, Half Text</option>
                        </select>
                    </label><br>
                    <label>Delay (ms): <input type="number" name="modes[${modeCount}][delay]" required></label><br>
                    <label>Direction: 
                        <select name="modes[${modeCount}][direction]" required>
                            <option value="1">Left to Right</option>
                            <option value="0">Right to Left</option>
                        </select>
                    </label>
                    <hr>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', modeHtml);
        }

        document.getElementById('displayModesForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = { modes: [] };

            for (let i = 1; i <= modeCount; i++) {
                const text = formData.get(`modes[${i}][text]`);
                const mode = parseInt(formData.get(`modes[${i}][mode]`));
                const delay = parseInt(formData.get(`modes[${i}][delay]`));
                const direction = formData.get(`modes[${i}][direction]`) === '1';

                data.modes.push({ text, mode, delay, direction });
            }

            const response = await fetch('api/modes', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            alert(result.message);
        });
    </script>
</body>
</html>
