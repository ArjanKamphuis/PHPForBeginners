<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>

<main>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Register for a new account</h2>
            </div>
            <form class="mt-8 space-y-6" action="/register" method="POST">
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required placeholder="Email address" value="<?= old('email') ?>"
                            class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Password"
                            class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div>
                    <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Register
                    </button>
                </div>
                <ul>
                    <?php if (isset($errors['email'])): ?>
                        <li class="text-red-500 text-xs mt-1"><?= $errors['email'] ?></li>
                    <?php endif; ?>
                    <?php if (isset($errors['password'])): ?>
                        <li class="text-red-500 text-xs mt-1"><?= $errors['password'] ?></li>
                    <?php endif; ?>
                </ul>
            </form>
        </div>
    </div>

</main>

<?php require base_path('views/partials/footer.php'); ?>
