@extends('layouts.public')

@section('title', 'About')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-16">
        <h1 class="text-4xl font-bold mb-6">About Us</h1>
        <p class="text-lg text-gray-700 leading-8">
            We are a modern e-commerce store dedicated to offering quality products with a smooth shopping experience.
            Our mission is to make online shopping simple, reliable, and enjoyable for every customer.
        </p>
        <div class="mt-10 grid md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Why choose us?</h2>
                <p class="text-gray-600">Fast delivery, trusted products, and friendly customer support.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-2">Our promise</h2>
                <p class="text-gray-600">We focus on quality, transparency, and a great shopping experience.</p>
            </div>
        </div>
    </div>
@endsection
