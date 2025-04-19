function loadCandidates() {
    fetch('candidates.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('candidates').innerHTML = data;
            document.getElementById('voteResults').innerHTML = data;
        });
}

function castVote() {
    let candidateId = prompt("Enter Candidate ID:");
    fetch('vote.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'candidate_id=' + candidateId
    })
    .then(response => response.text())
    .then(alert)
    .then(loadCandidates);
}

window.onload = loadCandidates;
