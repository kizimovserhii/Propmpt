<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use app\Controllers\AuthController;
use app\Controllers\BlockController;
use app\Controllers\PromptController;

Router::setDefaultNamespace('app\\controllers');

Router::post('/api/register', [AuthController::class, 'register'])->name('register');
Router::post('/api/login', [AuthController::class, 'login'])->name('login');
Router::post('/api/logout', [AuthController::class, 'logout'])->name('logout');

Router::post('/api/get-prompt-by-category', [BlockController::class, 'getAllPromptByCategory']);
Router::post('/api/update-prompts', [BlockController::class, 'updatePrompts']);

Router::post('/api/prompts', [PromptController::class, 'store'])->name('prompts.store');
Router::put('/api/prompts/{id}', [PromptController::class, 'update'])->name('prompts.update');
Router::delete('/api/prompts/{id}', [PromptController::class, 'destroy'])->name('prompts.destroy');

Router::get('/', [BlockController::class, 'home'])->name('home');

Router::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Router::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

Router::get('/prompts', [PromptController::class, 'index'])->name('prompts.index');
Router::get('/prompts/create', [PromptController::class, 'create'])->name('prompts.create');
Router::get('/prompts/{id}', [PromptController::class, 'show'])->name('prompts.show');
Router::get('/prompts/{id}/edit', [PromptController::class, 'edit'])->name('prompts.edit');