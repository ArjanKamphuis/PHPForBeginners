<?php require 'partials/head.php'; ?>
<?php require 'partials/nav.php'; ?>

<main>
    <div class="text-center mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold">Exception Thrown</h1>
        <p><?= $e->getMessage() ?></p>
        <p><a href="/" class="text-blue-500 hover:underline">Go back home.</a></p>
    </div>
</main>

<?php require 'partials/footer.php'; ?>
