@extends('layouts.public')

@section('title', 'Home')

@section('content')

    {{-- Cover Slider --}}
    <section
        x-data="{
            active: 0,
            slides: [
                {
                    image: '{{ asset('images/slider/slide_image.png') }}',
                    title: 'Discover Our Products',
                    text: 'Quality products at the best prices.'
                },
                {
                    image: '{{ asset('images/slider/slide_image2.jpeg') }}',
                    title: 'New Collection',
                    text: 'Explore our latest products.'
                },
                {
                    image: '{{ asset('images/slider/slide_image3.jpeg') }}',
                    title: 'Shop With Us',
                    text: 'Find everything you need in one place.'
                }
            ],
            next() {
                this.active = (this.active + 1) % this.slides.length
            },
            prev() {
                this.active = (this.active - 1 + this.slides.length) % this.slides.length
            }
        }"
        x-init="setInterval(() => next(), 5000)"
        class="relative w-full overflow-hidden"
    >

        {{-- Slides --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div
                x-show="active === index"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="relative h-[400px] md:h-[500px]"
            >

                {{-- Background Image --}}
                <img
                    :src="slide.image"
                    :alt="slide.title"
                    class="absolute inset-0 w-full h-full object-cover"
                >

                {{-- Dark Overlay --}}
                <div class="absolute inset-0 bg-black/40"></div>

                {{-- Content --}}
                <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-6">
                    <div>
                        <h1
                            class="text-4xl md:text-6xl font-bold mb-4"
                            x-text="slide.title"
                        ></h1>

                        <p
                            class="text-lg md:text-2xl mb-6"
                            x-text="slide.text"
                        ></p>

                        <a
                            href="#products"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition"
                        >
                            Shop Now
                        </a>
                    </div>
                </div>

            </div>
        </template>

        {{-- Previous Button --}}
        <button
            @click="prev()"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-20
                   bg-white/80 hover:bg-white text-gray-800
                   w-10 h-10 rounded-full shadow flex items-center justify-center"
        >
            ❮
        </button>

        {{-- Next Button --}}
        <button
            @click="next()"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-20
                   bg-white/80 hover:bg-white text-gray-800
                   w-10 h-10 rounded-full shadow flex items-center justify-center"
        >
            ❯
        </button>

        {{-- Dots --}}
        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button
                    @click="active = index"
                    class="w-3 h-3 rounded-full transition"
                    :class="active === index ? 'bg-white' : 'bg-white/50'"
                ></button>
            </template>
        </div>

    </section>


    {{-- Products --}}
    <div id="products" class="container mx-auto p-6">

        <h1 class="text-3xl font-bold mb-8 text-center">
            {{ $category ?? 'Our Products' }}
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($products as $product)

                <div class="bg-white p-4 rounded-lg shadow-md">

                    @if($product->image && count($product->image) > 0)
                        <a href="{{ route('public.products.show', $product->id) }}">
                            <img
                                src="{{ asset('storage/'.$product->image[0]) }}"
                                class="w-full h-48 object-cover rounded-md mb-4"
                                alt="{{ $product->name }}"
                            >
                        </a>
                    @endif

                    <h2 class="text-xl font-semibold mb-2">
                        <a
                            href="{{ route('public.products.show', $product->id) }}"
                            class="hover:text-blue-600"
                        >
                            {{ $product->name }}
                        </a>
                    </h2>

                    <p class="text-gray-600 mb-2">
                        <span class="font-bold">৳</span>
                        {{ $product->price1 }}
                    </p>

                    <a
                        href="{{ route('public.products.show', $product->id) }}"
                        class="text-sm text-blue-600 hover:text-blue-800 mb-3 inline-block"
                    >
                        View details
                    </a>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf

                        <button
                            type="submit"
                            class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition"
                        >
                            Add to Cart
                        </button>
                    </form>

                </div>

            @endforeach

        </div>
    </div>

@endsection