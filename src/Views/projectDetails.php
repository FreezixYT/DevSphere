<?php

?>

<div>
    
</div>

<script>
    const projectId = <?= $projectId ?>;
    const url = `/api/project/${projectId}`;
    main();

    async function main() {
        const response = await fetch(url);
        console.log(response);
        const project = await response.json();
        console.log(project);
    }
</script>