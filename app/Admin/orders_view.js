function updateStatus(transactionId) {
    document.getElementById('modal_transaction_id').value = transactionId;
    document.getElementById('statusModal').style.display = 'block';
}

document.querySelector('.close').onclick = function() {
    document.getElementById('statusModal').style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == document.getElementById('statusModal')) {
        document.getElementById('statusModal').style.display = 'none';
    }
}

function viewOrder(transactionId) {
    // Implement view order details functionality
    window.location.href = 'order_details.php?id=' + transactionId;
}