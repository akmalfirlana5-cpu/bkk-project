<div>
        @error('error')
            <div x-data="{ open: true }" x-show="open"
                class="w-full rounded-xl p-4  flex gap-2 mb-6 items-center border border-primary text-primary col-span-2">
                <svg class="w-6 h-6 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="paragraph-14r flex-1">{{ $message }}</span>
            </div>
        @enderror
        <form 
            wire:submit.prevent="login">
            <div class="w-full flex flex-col gap-3 mb-4">
                <label for="nisn" class="paragraph-16r text-bkkNeutral-900">NISN</label>
                <input 
                    id="nisn"
                    type="number" 
                    wire:model="nisn" 
                    placeholder="Masukkan NISN"
                    class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                    border border-bkkNeutral-100 rounded-2xl focus:border-primary py-3.5 px-6"/>
            </div>
            <div class="w-full flex flex-col gap-3 mb-9" x-data="{ showPassword: false }">
            <label for="password" class="paragraph-16r text-bkkNeutral-900">Password</label>
            
            <div class="relative">
                <input 
                    id="password"
                    :type="showPassword ? 'text' : 'password'" 
                    wire:model="password" 
                    placeholder="Masukkan Password"
                    class="w-full paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                    border border-bkkNeutral-100 rounded-2xl focus:border-primary py-3.5 pl-6 pr-12"/>

                <div 
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer text-bkkNeutral-500 hover:text-primary transition">
                
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <svg x-show="showPassword" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </div>
            </div>
            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
            <button 
                class="w-full px-6 py-3 bg-primary paragraph-16s hover:bg-primary-hover text-bkkNeutral-50 rounded-lg cursor-pointer transition duration-300 mb-3"
                type="submit">
                Masuk
            </button>
            <div class="paragraph-14r text-bkkNeutral-600 text-center">
                Lupa password?
                <a 
                    href="{{ route('kontak') }}"
                    class="text-primary cursor-pointer">
                    Hubungi admin BKK
                </a>
            </div>
        </form>
        {{-- close button --}}
        <div 
            @click="$dispatch('close-modal')"
            class="absolute top-6 right-6 text-bkkNeutral-900 cursor-pointer">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 18L12 12M12 12L6 6M12 12L18 6M12 12L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        {{-- Student icon --}}
        <div 
            class="w-[120px] h-[120px] bg-bkkNeutral-50 absolute -top-[15%] justify-self-center flex justify-center items-center rounded-full z-99">
            <img 
                class="w-[56px] h-[70px] object-cover object-center"
                src="{{ asset('/assets/static/logo/icon/Student logo.webp') }}"/>
        </div>
</div>
