let sessionId = localStorage.getItem('session_id');
if (!sessionId) {
    sessionId = crypto.randomUUID();
    localStorage.setItem('session_id', sessionId);
}


async function trackVisit() {

    try {
        await fetch('/template/Partsix/partsix/tracking/track_users.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                session_id: sessionId,
                page_url: window.location.href,
                referrer: document.referrer,
                page: window.location.pathname  // <-- добавляем страницу
            })
        });
    } catch (error) {
        console.error('Tracking error:', error);
    }
}

document.addEventListener('DOMContentLoaded', trackVisit);
