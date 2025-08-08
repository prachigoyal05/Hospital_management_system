@extends('layouts.admin')

@section('content')
<div class="p-4">
    <h2 class="text-2xl text-red-700 font-bold mb-4">Settings</h2>

    <ul class="flex space-x-4 border-b mb-4">
    <li><a href="#general" class="tab-link text-green-600 font-bold border-b-2 border-green-600 pb-2">General</a></li>
    <li><a href="#lab" class="tab-link font-bold text-green-600 hover:text-green-600 pb-2">Lab Preferences</a></li>
    <li><a href="#users" class="tab-link font-bold text-green-600 hover:text-green-600 pb-2">User Management</a></li>
    <li><a href="#security" class="tab-link font-bold text-green-600 hover:text-green-600 pb-2">Security</a></li>
</ul>

    <div id="general" class="tab-content p-6 bg-white rounded-lg shadow-sm border border-gray-200">
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tab" value="general">
        
        <h3 class="text-lg font-semibold text-green-600 mb-6 pb-2 border-b border-gray-200">General Settings</h3>   
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Site Name -->
            <div>
                
                <label class="block text-sm font-medium text-gray-700 mb-1">Site Name *</label>
                <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                       placeholder="Enter your site name"
                       required>
                <p class="mt-1 text-xs text-gray-500">This will appear in page titles and emails</p>
            </div>
            
            <!-- Logo Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Site Logo</label>
                <div class="flex items-center space-x-4">
                    @if($settings['site_logo'] ?? false)
                    <img src="{{ Storage::url($settings['site_logo']) }}" alt="Site Logo" class="h-12 w-auto border rounded p-1 bg-gray-50">
                    @endif
                    <div class="flex-1">
                        <input type="file" name="site_logo" accept="image/*" 
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-1 text-xs text-red-500">Recommended size: 200x50px (PNG, JPG)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional General Settings -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Contact Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Email *</label>
                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                       placeholder="contact@example.com"
                       required>
            </div>
            
            <!-- Phone Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="tel" name="phone_number" value="{{ $settings['phone_number'] ?? '' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                       placeholder="+1 (555) 123-4567">
            </div>
        </div>
        
        <!-- Save Button -->
        <div class="flex justify-end pt-4 border-t border-gray-200">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save Settings
            </button>
        </div>
    </form>
</div>

     <!-- Lab preference tab -->
     <div id="lab" class="tab-content p-6 bg-white rounded-lg shadow-sm border border-gray-200">
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        <input type="hidden" name="tab" value="lab">
        
        <h3 class="text-lg font-semibold text-red-500 mb-6 pb-2 border-b border-gray-200">Lab Preferences</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Operating Hours -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Operating Hours *</label>
                <input type="text" name="lab_hours" value="{{ $settings['lab_hours'] ?? '9:00 AM - 5:00 PM' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                       placeholder="e.g. 8:00 AM - 6:00 PM"
                       required>
                <p class="mt-1 text-xs text-gray-500">Example format: 9:00 AM - 5:00 PM, Monday-Friday</p>
            </div>
            
            <!-- Contact Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Primary Contact Number *</label>
                <input type="tel" name="lab_contact" value="{{ $settings['lab_contact'] ?? '' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                       placeholder="+1 (555) 123-4567"
                       required>
                <p class="mt-1 text-xs text-gray-500">Include country code if applicable</p>
            </div>
        </div>
        
        <!-- Additional Lab Settings -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Emergency Contact -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Emergency After-Hours Contact</label>
                <input type="text" name="emergency_contact" value="{{ $settings['emergency_contact'] ?? '' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                       placeholder="Name or number">
            </div>
            
            <!-- Lab Location -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lab Location</label>
                <input type="text" name="lab_location" value="{{ $settings['lab_location'] ?? '' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                       placeholder="Building/Room number">
            </div>
        </div>
        
        <!-- Weekday Specific Hours -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-3">Detailed Weekly Schedule</label>
            <div class="space-y-3">
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                <div class="flex items-center space-x-4">
                    <span class="w-24 text-sm text-gray-700">{{ $day }}</span>
                    <input type="time" name="lab_hours_{{ strtolower($day) }}_open" 
                           value="{{ $settings['lab_hours_'.strtolower($day).'_open'] ?? '09:00' }}"
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md">
                    <span class="text-gray-500">to</span>
                    <input type="time" name="lab_hours_{{ strtolower($day) }}_close" 
                           value="{{ $settings['lab_hours_'.strtolower($day).'_close'] ?? '17:00' }}"
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md">
                    <div class="flex items-center ml-4">
                        <input type="checkbox" id="{{ strtolower($day) }}_closed" 
                               name="lab_hours_{{ strtolower($day) }}_closed" value="1"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                               {{ ($settings['lab_hours_'.strtolower($day).'_closed'] ?? false) ? 'checked' : '' }}>
                        <label for="{{ strtolower($day) }}_closed" class="ml-2 text-sm text-gray-700">Closed</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Save Button -->
        <div class="flex justify-end pt-4 border-t border-gray-200">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save Lab Preferences
            </button>
        </div>
    </form>
</div>

<!-- User management tab  -->
 <div id="users" class="tab-content p-6 bg-white rounded-lg shadow-sm border border-gray-200">
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        <input type="hidden" name="tab" value="users">
        
        <h3 class="text-lg font-semibold text-red-500 mb-6 pb-2 border-b border-gray-200">User Management Settings</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Default User Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Default User Role *</label>
                <select name="default_user_role" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="staff" {{ ($settings['default_user_role'] ?? 'staff') == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="technician" {{ ($settings['default_user_role'] ?? '') == 'technician' ? 'selected' : '' }}>Technician</option>
                    <option value="admin" {{ ($settings['default_user_role'] ?? '') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="viewer" {{ ($settings['default_user_role'] ?? '') == 'viewer' ? 'selected' : '' }}>Viewer (Read-only)</option>
                </select>
                <p class="mt-1 text-xs text-gray-500">Role assigned to new registered users</p>
            </div>
            
            <!-- Max Login Attempts -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Max Login Attempts *</label>
                <input type="number" name="max_login_attempts" min="1" max="10" 
                       value="{{ $settings['max_login_attempts'] ?? '5' }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required>
                <p class="mt-1 text-xs text-gray-500">Before temporary lockout (1-10)</p>
            </div>
        </div>
        
        <!-- Security Settings -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Account Activation -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Account Activation</label>
                <select name="account_activation" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="auto" {{ ($settings['account_activation'] ?? 'auto') == 'auto' ? 'selected' : '' }}>Automatic upon registration</option>
                    <option value="manual" {{ ($settings['account_activation'] ?? '') == 'manual' ? 'selected' : '' }}>Require admin approval</option>
                    <option value="email" {{ ($settings['account_activation'] ?? '') == 'email' ? 'selected' : '' }}>Require email verification</option>
                </select>
            </div>
            
            <!-- Password Reset -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Reset Expiry</label>
                <div class="flex items-center">
                    <input type="number" name="password_reset_expiry" min="1" max="24" 
                           value="{{ $settings['password_reset_expiry'] ?? '2' }}"
                           class="w-20 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">hours</span>
                </div>
                <p class="mt-1 text-xs text-gray-500">Reset link validity duration</p>
            </div>
        </div>
        
        <!-- Checkbox Options -->
        <div class="space-y-4 mb-6">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="allow_registration" name="allow_registration" type="checkbox" 
                           class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                           {{ ($settings['allow_registration'] ?? true) ? 'checked' : '' }}>
                </div>
                <div class="ml-3 text-sm">
                    <label for="allow_registration" class="font-medium text-gray-700">Allow new user registration</label>
                    <p class="text-gray-500">Enable public registration of new accounts</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="notify_admin_new_user" name="notify_admin_new_user" type="checkbox" 
                           class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                           {{ ($settings['notify_admin_new_user'] ?? true) ? 'checked' : '' }}>
                </div>
                <div class="ml-3 text-sm">
                    <label for="notify_admin_new_user" class="font-medium text-gray-700">Notify admins of new users</label>
                    <p class="text-gray-500">Send email notification when new users register</p>
                </div>
            </div>
        </div>
        
        <!-- Save Button -->
        <div class="flex justify-end pt-4 border-t border-gray-200">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save User Settings
            </button>
        </div>
    </form>
</div>

<!-- security -->
 <div id="security" class="tab-content p-6 bg-white rounded-lg shadow-sm border border-gray-200">
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        <input type="hidden" name="tab" value="security">
        
        <h3 class="text-lg font-semibold text-red-500 mb-6 pb-2 border-b border-gray-200">Security Settings</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Password Policy -->
            <div class="md:col-span-2">
                <h4 class="text-md font-medium text-black-500 mb-3">Password Policy</h4>
                <div class="space-y-4 pl-4 border-l-2 border-blue-100">
                    <!-- Password Expiry -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Expiry (days)</label>
                        <div class="flex items-center space-x-2">
                            <input type="number" name="password_expiry" min="0" max="365" 
                                   value="{{ $settings['password_expiry'] ?? '90' }}"
                                   class="w-24 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <span class="text-sm text-gray-500">(0 = never expire)</span>
                        </div>
                    </div>
                    
                    <!-- Password Requirements -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password Requirements</label>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="require_mixed_case" name="require_mixed_case" type="checkbox"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                       {{ ($settings['require_mixed_case'] ?? true) ? 'checked' : '' }}>
                                <label for="require_mixed_case" class="ml-2 block text-sm text-gray-700">Require uppercase and lowercase letters</label>
                            </div>
                            <div class="flex items-center">
                                <input id="require_numbers" name="require_numbers" type="checkbox"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                       {{ ($settings['require_numbers'] ?? true) ? 'checked' : '' }}>
                                <label for="require_numbers" class="ml-2 block text-sm text-gray-700">Require at least one number</label>
                            </div>
                            <div class="flex items-center">
                                <input id="require_special_chars" name="require_special_chars" type="checkbox"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                       {{ ($settings['require_special_chars'] ?? false) ? 'checked' : '' }}>
                                <label for="require_special_chars" class="ml-2 block text-sm text-gray-700">Require special characters</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Minimum Password Length -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Minimum Password Length</label>
                        <input type="number" name="min_password_length" min="6" max="32" 
                               value="{{ $settings['min_password_length'] ?? '8' }}"
                               class="w-24 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>
            
            <!-- Two-Factor Authentication -->
            <div class="md:col-span-2">
                <h4 class="text-md font-medium text-gray-700 mb-3">Two-Factor Authentication</h4>
                <div class="space-y-4 pl-4 border-l-2 border-blue-100">
                    <!-- Enable 2FA -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="enable_2fa" name="enable_2fa" type="checkbox"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   {{ ($settings['enable_2fa'] ?? false) ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="enable_2fa" class="font-medium text-gray-700">Enable Two-Factor Authentication</label>
                            <p class="text-gray-500">Require users to verify their identity using a second factor</p>
                        </div>
                    </div>
                    
                    <!-- 2FA Methods -->
                    <div class="ml-7 space-y-2">
                        <div class="flex items-center">
                            <input id="2fa_email" name="2fa_methods[]" type="checkbox" value="email"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   {{ in_array('email', explode(',', $settings['2fa_methods'] ?? '')) ? 'checked' : '' }}>
                            <label for="2fa_email" class="ml-2 block text-sm text-gray-700">Email verification</label>
                        </div>
                        <div class="flex items-center">
                            <input id="2fa_authenticator" name="2fa_methods[]" type="checkbox" value="authenticator"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   {{ in_array('authenticator', explode(',', $settings['2fa_methods'] ?? '')) ? 'checked' : '' }}>
                            <label for="2fa_authenticator" class="ml-2 block text-sm text-gray-700">Authenticator app (TOTP)</label>
                        </div>
                        <div class="flex items-center">
                            <input id="2fa_sms" name="2fa_methods[]" type="checkbox" value="sms"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   {{ in_array('sms', explode(',', $settings['2fa_methods'] ?? '')) ? 'checked' : '' }}>
                            <label for="2fa_sms" class="ml-2 block text-sm text-gray-700">SMS verification</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Session Management -->
            <div class="md:col-span-2">
                <h4 class="text-md font-medium text-gray-700 mb-3">Session Management</h4>
                <div class="space-y-4 pl-4 border-l-2 border-blue-100">
                    <!-- Session Timeout -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Session Timeout (minutes)</label>
                        <input type="number" name="session_timeout" min="5" max="1440" 
                               value="{{ $settings['session_timeout'] ?? '30' }}"
                               class="w-24 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <!-- Concurrent Sessions -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Max Concurrent Sessions</label>
                        <input type="number" name="max_concurrent_sessions" min="1" max="10" 
                               value="{{ $settings['max_concurrent_sessions'] ?? '3' }}"
                               class="w-24 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Save Button -->
        <div class="flex justify-end pt-4 border-t border-gray-200">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save Security Settings
            </button>
        </div>
    </form>
</div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach((tab, index) => {
        if (index !== 0) tab.classList.add('hidden');
    });
});

    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('href').substring(1);

            document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
            document.getElementById(target).classList.remove('hidden');
        });
    });
</script>

@endsection
