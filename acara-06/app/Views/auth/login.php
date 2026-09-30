<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - SI Akademik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card">

                <div class="card-body">

                    <h2 class="mb-4">Login SI Akademik</h2>

                    <?php if (!empty($_SESSION['flash'])): ?>

                        <div class="alert alert-success">
                            <?= htmlspecialchars($_SESSION['flash']) ?>
                        </div>

                        <?php unset($_SESSION['flash']); ?>

                    <?php endif; ?>

                    <?php if (!empty($_SESSION['error'])): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['error']) ?>
                        </div>

                        <?php unset($_SESSION['error']); ?>

                    <?php endif; ?>

                    <form action="<?= BASE_PATH ?>/login" method="POST">

                        <div class="mb-3">
                            <label for="username" class="form-label">
                                Username
                            </label>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>

                    </form>

                    <div class="mt-3">
                        <small>
                            Username: <strong>admin</strong><br>
                            Password: <strong>admin123</strong>
                        </small>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>