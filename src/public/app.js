/**
 * Updates the card with the specified cardId to the specified statusId.
 * @param {string} cardId - The ID of the card to be updated.
 * @param {string} statusId - The ID of the status to update the card to.
 */
function postCardUpdate(cardId, statusId) {
    const form = new FormData();
    form.append('card_id', cardId);
    form.append('status_id', statusId);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch('/card?move=true', {
        method: 'POST',
        body: form,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    }).then((response) => {
        document.body.dispatchEvent(new Event('card-moved'));
    });
}


// This event listener is triggered after htmx settles (finishes) an AJAX request and updates the dom
htmx.on('htmx:afterSettle', function(evt) {
    let dragTarget = null;

    // Get all elements with the class "droppable"
    const dropElements = document.getElementsByClassName("droppable");
    // Get all elements with the class "draggable"
    const dragElements = document.getElementsByClassName("draggable");

    // Loop through each draggable element
    for (let i = 0; i < dragElements.length; i++) {
        const dragElement = dragElements[i];
        
        // Add a dragstart event listener to each draggable element
        dragElement.addEventListener("dragstart", (event) => {
            console.log('dragstart');
            dragTarget = event.target;
        });
        
        // Add a dragend event listener to each draggable element
        dragElement.addEventListener("dragend", (event) => {
            console.log('dragend');
            dragTarget = null;
        });
    }
   
    // Loop through each droppable element
    for (let i = 0; i < dropElements.length; i++) {
        const dropElement = dropElements[i];
        
        // Add a dragenter event listener to each droppable element
        dropElement.addEventListener("dragenter", (event) => {
            console.log('dragenter');
            event.preventDefault();
        });
        
        // Add a dragover event listener to each droppable element
        dropElement.addEventListener("dragover", (event) => {
            console.log('dragenter');
            event.preventDefault();
        });

        // Add a drop event listener to each droppable element
        dropElement.addEventListener("drop", (event) => {
            // Get the status ID of the drop target
            let dropStatusId = event.target.getAttribute('data-status-id');
            if (!dropStatusId) {
                // If the drop target does not have a status ID, traverse up the DOM tree to find a parent element with a status ID
                let parentElement = event.target.parentElement;
                while (parentElement && !dropStatusId) {
                    dropStatusId = parentElement.getAttribute('data-status-id');
                    parentElement = parentElement.parentElement;
                }
            }
            // Get the card ID of the dragged element
            const cardId = dragTarget.getAttribute('data-card-id');
            // Call the postCardUpdate function to update the card's status
            postCardUpdate(cardId, dropStatusId);
            event.preventDefault();
        });
    }
});

