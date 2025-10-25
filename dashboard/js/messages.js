let messages = [];
let currentFilter = 'all';

// Fetch and display messages
function display_data() {
    fetch("db/messages-data.php")
        .then(r => {
            if (!r.ok) throw new Error("Network response was not ok");
            return r.json();
        })
        .then((data) => {
            messages = data;
            displayMessages(); // Display after fetching
        })
        .catch((error) => {
            console.error("Fetch error:", error);
        });
}

// Format date for display
function formatDate(dateString) {
    const date = new Date(dateString);
    const today = new Date();
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);
    
    if (date.toDateString() === today.toDateString()) {
        return "Aujourd'hui";
    } else if (date.toDateString() === yesterday.toDateString()) {
        return "Hier";
    } else {
        return date.toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
}

// Expand message
function toggleMessage(messageId) {
    const message = messages.find(m => m.id === messageId);
    if (!message.read) {
        markAsRead(messageId);
    }

    const preview = document.getElementById(`preview-${messageId}`);
    const full = document.getElementById(`full-${messageId}`);
    const btn = document.getElementById(`btn-${messageId}`);
    
    if (full.style.display === 'none' || full.style.display === '') {
        preview.style.display = 'none';
        full.style.display = 'block';
        btn.innerHTML = '<i class="fa-solid fa-caret-up"></i> Masquer le message';
    } else {
        preview.style.display = 'block';
        full.style.display = 'none';
        btn.innerHTML = '<i class="fa-solid fa-caret-down"></i> Voir le message complet';
    }
}

// Delete message (with animation)
function deleteMessage(messageId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce message ?')) {
        const messageCard = document.querySelector(`[data-message-id="${messageId}"]`);
        fetch("db/delete-message.php",{
            headers:{
                'Content-Type': 'application/json'
            },
            method: 'post',
            body: JSON.stringify({'id': messageId})
        })
        .then(r=>r.json())
        .then(data=>{
            if(data.success==true){
               messageCard.classList.add('deleting');
                setTimeout(() => {
                    messages = messages.filter(m => m.id !== messageId);
                    displayMessages();
                }, 500); 
            }
        })
    }
}

// Mark one message as read
function markAsRead(messageId) {
    const message = messages.find(m => m.id === messageId);
    if (message) {
        message.read = true;
        updateMessageCard(messageId);
        updateStats();
    }
}

// Toggle read/unread status
function toggleReadStatus(messageId) {
    const message = messages.find(m => m.id === messageId);
    if (message) {
        message.read = !message.read;
        updateMessageCard(messageId);
        updateStats();
    }
}

// Update the visual of a message card
function updateMessageCard(messageId) {
    const card = document.querySelector(`[data-message-id="${messageId}"]`);
    const message = messages.find(m => m.id === messageId);
    
    if (card && message) {
        const statusElement = card.querySelector('.read-status');
        const readBtn = card.querySelector('.read-btn');
        
        card.className = `message-card ${message.read ? 'read' : 'unread'}`;
        
        if (message.read) {
            statusElement.textContent = '✓ Lu';
            statusElement.className = 'read-status read';
            readBtn.innerHTML = '<i class="fa-solid fa-eye"></i>';
            readBtn.title = 'Marquer comme non lu';
        } else {
            statusElement.textContent = '● Nouveau';
            statusElement.className = 'read-status unread';
            readBtn.innerHTML = '✓';
            readBtn.title = 'Marquer comme lu';
        }
    }
}

// Mark all messages as read
function markAllAsRead() {
    messages.forEach(message => {
        message.read = true;
    });
    displayMessages();
}

// Handle message filtering
function filterMessages(filter) {
    currentFilter = filter;

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });

    const selectedBtn = document.querySelector(`[data-filter="${filter}"]`);
    if (selectedBtn) selectedBtn.classList.add('active');

    displayMessages();
}

// Return filtered messages based on current filter
function getFilteredMessages() {
    switch (currentFilter) {
        case 'unread':
            return messages.filter(m => !m.read);
        case 'read':
            return messages.filter(m => m.read);
        default:
            return messages;
    }
}

// Update message stats display
function updateStats() {
    const today = new Date().toDateString();
    const unreadCount = messages.filter(m => !m.read).length;
    const todayCount = messages.filter(m => {
        const messageDate = new Date(m.date);
        return messageDate.toDateString() === today;
    }).length;

    document.getElementById('totalMessages').textContent = messages.length;
    document.getElementById('unreadMessages').textContent = unreadCount;
    document.getElementById('todayMessages').textContent = todayCount;
}

// Render all messages in the UI
function displayMessages() {
    const container = document.getElementById('messagesContainer');
    const emptyState = document.getElementById('emptyState');
    const filteredMessages = getFilteredMessages();

    container.innerHTML = '';

    if (filteredMessages.length === 0) {
        emptyState.style.display = 'block';
        return;
    } else {
        emptyState.style.display = 'none';
    }

    filteredMessages.forEach((message, index) => {
        const messageCard = document.createElement('div');
        messageCard.className = `message-card ${message.read ? 'read' : 'unread'}`;
        messageCard.style.animationDelay = `${index * 0.1}s`;
        messageCard.setAttribute('data-message-id', message.id);

        messageCard.innerHTML = `
            <div class="message-status">
                <span class="read-status ${message.read ? 'read' : 'unread'}">
                    ${message.read ? '✓ Lu' : '● Nouveau'}
                </span>
                <div class="message-actions">
                    <button class="action-btn read-btn" onclick="toggleReadStatus(${message.id})" 
                            title="${message.read ? 'Marquer comme non lu' : 'Marquer comme lu'}">
                        ${message.read ? '<i class="fa-solid fa-eye"></i>' : '✓'}
                    </button>
                    <button class="action-btn delete-btn" onclick="deleteMessage(${message.id})" 
                        title="Supprimer le message">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>
            <div class="message-header">
                <div class="sender-info">
                    <h3><i class="fa-solid fa-user"></i>${message.name}</h3>
                    <div class="sender-email"><i class="fa-solid fa-envelope"></i>${message.email}</div>
                    <div class="message-date"><i class="fa-solid fa-calendar"></i>${formatDate(message.date)}</div>
                </div>
            </div>
            <div class="message-preview" id="preview-${message.id}">
                ${message.message.slice(0,200)}...
            </div>
            <div class="message-full" id="full-${message.id}">
                ${message.message}
            </div>
            <button class="toggle-btn" id="btn-${message.id}" onclick="toggleMessage(${message.id})">
                <i class="fa-solid fa-caret-down"></i> Voir le message complet
            </button>
        `;

        container.appendChild(messageCard);
    });

    updateStats();
}

// Initialize filters
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
        filterMessages(e.target.dataset.filter);
    });
});

// Load data on page ready
document.addEventListener('DOMContentLoaded', () => {
    display_data(); // ✅ Correctly fetch and display messages on load
});