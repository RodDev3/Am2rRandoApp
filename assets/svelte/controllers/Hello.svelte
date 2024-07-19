<script>
    import { fade } from 'svelte/transition';
    export let name = "Svelte";
</script>

<div transition:fade|global>Hello {name}</div>