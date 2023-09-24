document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.querySelector("#textInput"); // Use the ID selector for textarea
    const button = document.querySelector("#convertButton"); // Use the ID selector for the button
    const clearButton = document.querySelector("#clearButton"); // Use the ID selector for the clear button

    let isSpeaking = true; // Change the initial state to false


    // Function for text-to-speech conversion
    const textToSpeech = () => {
        // Access the browser's speech synthesis API
        const synth = window.speechSynthesis;
        const text = textarea.value;

        // Check if there's an existing utterance and cancel it
        if (currentUtterance && synth.speaking) {
            synth.cancel();
        }

        // Check if speech synthesis is not currently speaking and there is text to speak
        if (!synth.speaking && text) {
            // Create a new SpeechSynthesisUtterance object with the text
            const utterance = new SpeechSynthesisUtterance(text);

            // Set the current position to where speech synthesis was paused

            // Start speaking the text using the speech synthesis API
            synth.speak(utterance);

            // Store the current utterance
            currentUtterance = utterance;
        }

        // Check if the length of the text is greater than 1 character
        if (text.length > 50) {
            // If speech synthesis is speaking and the "isSpeaking" flag is true
            if (synth.speaking && isSpeaking) {
                // Change the text of the <button> to "Pause"
                button.innerText = "Stop";

                // Resume the speech synthesis (if paused)
                synth.resume();

                // Set the "isSpeaking" flag to false
                isSpeaking = false;
            } else {
                // If not speaking or "isSpeaking" is false
                // Change the text of the <button> to "Resume"
                button.innerText = "Play";

                // Pause the speech synthesis (if speaking)
                synth.pause();

                // Set the "isSpeaking" flag to true
                isSpeaking = true;
            }
        } else {
            // If the text length is not greater than 1 character
            // Set the "isSpeaking" flag to false
            isSpeaking = false;

            // Change the text of the <button> to "Speaking..."
            button.innerText = "Speaking...";
        }

        // Set an interval to continuously check if speech synthesis has finished
        setInterval(() => {
            // If speech synthesis is not speaking and "isSpeaking" is false
            if (!synth.speaking && !isSpeaking) {
                // Set the "isSpeaking" flag to true
                isSpeaking = true;

                // Change the text of the <button> to "Convert to Speech"
                button.innerText = "Convert to Speech";
            }
        });
    };




    // Function to clear the textarea and reset the state
    const clearTextarea = () => {
        textarea.value = "";
        isSpeaking = false;
        button.innerText = "Convert to Speech";
        pausePosition = 0;

        if (currentUtterance) {
            currentUtterance.onend = null; // Remove any existing end event listener
            window.speechSynthesis.cancel();
            currentUtterance = null;
        }
    };

    // Add a click event listener to the <button> element
    button.addEventListener("click", textToSpeech);
    // Add a click event listener to the clear button
    clearButton.addEventListener('click', clearTextarea);

    /* When isSpeaking is set to true, it typically means that speech synthesis is active or in progress.
    When isSpeaking is set to false, it usually means that speech synthesis is not active or has finished. */
});
