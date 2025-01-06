// Get modal elements
const statusModal = document.getElementById('statusModal');
const closeBtn = document.querySelector('.close');
const updateStatusForm = document.getElementById('updateStatusForm');
const modalTransactionId = document.getElementById('modal_transaction_id');

function updateStatus(transactionId) {
    // Get the current status for this order
    const statusCell = document.querySelector(`tr[data-id="${transactionId}"] .status-badge`);
    const currentStatus = statusCell ? statusCell.textContent.trim().toLowerCase() : '';
    
    // Show the modal
    const modal = document.getElementById('statusModal');
    modal.style.display = "block";
    
    // Set the transaction ID in the hidden field
    document.getElementById('modal_transaction_id').value = transactionId;
    
    // Set the current status in the dropdown
    const statusSelect = document.getElementById('new_status');
    if (statusSelect && currentStatus) {
        statusSelect.value = currentStatus;
    }
    
    // Close button functionality
    const closeBtn = document.getElementsByClassName("close")[0];
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }
    
    // Click outside modal to close
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

// Add form submission handler
document.getElementById('updateStatusForm').addEventListener('submit', function(e) {
    // Add any validation if needed
    const newStatus = document.getElementById('new_status').value;
    if (!newStatus) {
        e.preventDefault();
        alert('Please select a status');
        return false;
    }
});