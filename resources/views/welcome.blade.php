<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>P10 Display Preview</title>
<style>
    /* Set up the main display area */
    #display {
        width: 512px;  /* Set width to represent P10 width */
        height: 64px;  /* Set height for a 2x display */
        background-color: black; /* Background color to simulate LED display */
        color: green;  /* Text color for LED effect */
        font-family: Arial, sans-serif;
        font-size: 24px;
        overflow: hidden;
        position: relative;
    }
    /* Marquee text style */
    .marquee {
        position: absolute;
        white-space: nowrap;
    }
    @keyframes marquee {
    from { left: 100%; }
    to { left: -100%; }
}
</style>
</head>
<body>

<div id="display">
    <div id="marqueeText1" class="marquee"></div>
    <div id="marqueeText2" class="marquee" style="top: 32px;"></div>
</div>

<script>
// Sample display data
const displayModes = [
    { text1: "Welcome to the P10", text2: "This is line 2", mode: 1, delay1: 5000, delay2: 5000, direction1: true, direction2: false },
    { text1: "News Headline", text2: "Weather Update", mode: 2, delay1: 1500, delay2: 1500, direction1: false, direction2: false },
    { text1: "Clock: 12:00 PM", mode: 3, delay1: 1000 }
];

let currentModeIndex = 0;

function updateDisplay() {
    const display = document.getElementById('display');
    const marqueeText1 = document.getElementById('marqueeText1');
    const marqueeText2 = document.getElementById('marqueeText2');

    // Get the current display mode
    const mode = displayModes[currentModeIndex];

    // Clear previous animations
    marqueeText1.style.animation = '';
    marqueeText2.style.animation = '';
    
    if (mode.mode === 1) {
        marqueeText1.innerText = mode.text1;
        marqueeText1.style.left = '100%';

        // Animate marquee to move from right to left
        marqueeText1.style.animation = `marquee ${mode.delay1 / 1000}s linear infinite`;

    } else if (mode.mode === 2) {
        marqueeText1.innerText = mode.text1;
        marqueeText2.innerText = mode.text2;

        // No marquee, just update text line by line
        setTimeout(() => {
            marqueeText1.style.left = '10px';
            marqueeText2.style.left = '10px';
        }, mode.delay1);
        
    } else if (mode.mode === 3) {
        // Display clock and half text
        marqueeText1.innerText = "Clock: 12:00 PM"; // Update with actual time logic if needed
        marqueeText2.innerText = mode.text1;
    }

    // Move to the next mode after delay
    currentModeIndex = (currentModeIndex + 1) % displayModes.length;
    setTimeout(updateDisplay, mode.delay1 + mode.delay2);
}

// Start the display update loop
updateDisplay();

</script>
</body>
</html>
