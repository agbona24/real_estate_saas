@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<div class="h-[calc(100vh-8rem)]">
    <div class="bg-white rounded-lg shadow h-full flex overflow-hidden">
        <!-- Conversations List -->
        <div class="w-1/3 border-r border-gray-200 flex flex-col">
            <!-- Search Header -->
            <div class="p-4 border-b border-gray-200">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" placeholder="Search conversations..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <!-- Conversations -->
            <div class="flex-1 overflow-y-auto" x-data="{ selected: 1 }">
                @foreach($conversations ?? [] as $conversation)
                    <div @click="selected = {{ $conversation->id ?? 1 }}"
                         :class="selected === {{ $conversation->id ?? 1 }} ? 'bg-indigo-50 border-l-4 border-indigo-600' : 'border-l-4 border-transparent hover:bg-gray-50'"
                         class="p-4 cursor-pointer transition">
                        <div class="flex items-start space-x-3">
                            <div class="relative flex-shrink-0">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($conversation->participant ?? 'User') }}" class="h-12 w-12 rounded-full" alt="">
                                @if($conversation->online ?? false)
                                    <span class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 border-2 border-white rounded-full"></span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $conversation->participant ?? 'Sarah Johnson' }}</p>
                                    <p class="text-xs text-gray-500 flex-shrink-0 ml-2">{{ $conversation->time ?? '10:30 AM' }}</p>
                                </div>
                                <p class="text-xs text-gray-600 mb-1">{{ $conversation->role ?? 'Senior Realtor' }}</p>
                                <p class="text-sm text-gray-700 truncate">{{ $conversation->last_message ?? 'The property inspection has been scheduled...' }}</p>
                                @if($conversation->unread ?? 0)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mt-1">
                                        {{ $conversation->unread }} new
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- New Conversation Button -->
            <div class="p-4 border-t border-gray-200">
                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                    <i class="fas fa-plus mr-2"></i> New Message
                </button>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 flex flex-col">
            <!-- Chat Header -->
            <div class="p-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($active_chat->participant ?? 'Agent') }}" class="h-10 w-10 rounded-full" alt="">
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $active_chat->participant ?? 'Sarah Johnson' }}</h3>
                            <p class="text-xs text-gray-600">
                                @if($active_chat->typing ?? false)
                                    <i class="fas fa-circle text-green-500 text-xs mr-1"></i>
                                    <span class="text-green-600">Typing...</span>
                                @else
                                    <i class="fas fa-circle {{ ($active_chat->online ?? false) ? 'text-green-500' : 'text-gray-400' }} text-xs mr-1"></i>
                                    {{ ($active_chat->online ?? false) ? 'Online' : 'Last seen '.($ active_chat->last_seen ?? '2 hours ago') }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="text-gray-600 hover:text-gray-900 p-2 rounded hover:bg-gray-100" title="Call">
                            <i class="fas fa-phone"></i>
                        </button>
                        <button class="text-gray-600 hover:text-gray-900 p-2 rounded hover:bg-gray-100" title="Video Call">
                            <i class="fas fa-video"></i>
                        </button>
                        <button class="text-gray-600 hover:text-gray-900 p-2 rounded hover:bg-gray-100" title="More Options">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Messages Area -->
            <div class="flex-1 overflow-y-auto p-6 bg-gray-50" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48Y2lyY2xlIGZpbGw9IiNGNUY1RjUiIGN4PSIyMCIgY3k9IjIwIiByPSIxIi8+PC9nPjwvc3ZnPg==');">
                <div class="space-y-4 max-w-4xl mx-auto">
                    <!-- Date Divider -->
                    <div class="flex items-center justify-center my-4">
                        <div class="bg-white rounded-full px-4 py-1 text-xs text-gray-600 shadow-sm">
                            Today
                        </div>
                    </div>

                    @foreach($messages ?? [] as $message)
                        @if($message->sender_id === auth()->id())
                            <!-- Sent Message (Right) -->
                            <div class="flex justify-end">
                                <div class="max-w-md">
                                    <div class="bg-indigo-600 text-white rounded-lg rounded-tr-none px-4 py-2 shadow">
                                        @if($message->type === 'file')
                                            <div class="flex items-center space-x-3 bg-indigo-700 rounded-lg p-3 mb-2">
                                                <i class="fas fa-file-pdf text-2xl"></i>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium">{{ $message->file_name ?? 'document.pdf' }}</p>
                                                    <p class="text-xs opacity-75">{{ $message->file_size ?? '2.4 MB' }}</p>
                                                </div>
                                                <button class="text-white hover:text-indigo-100">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </div>
                                        @endif
                                        <p class="text-sm">{{ $message->content ?? 'Thank you! I will be there on time.' }}</p>
                                    </div>
                                    <div class="flex items-center justify-end space-x-2 mt-1 px-1">
                                        <p class="text-xs text-gray-500">{{ $message->time ?? '10:32 AM' }}</p>
                                        @if($message->read ?? false)
                                            <i class="fas fa-check-double text-blue-500 text-xs"></i>
                                        @else
                                            <i class="fas fa-check text-gray-400 text-xs"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Received Message (Left) -->
                            <div class="flex justify-start">
                                <div class="flex items-start space-x-2 max-w-md">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($message->sender_name ?? 'Sender') }}" class="h-8 w-8 rounded-full flex-shrink-0" alt="">
                                    <div>
                                        <div class="bg-white rounded-lg rounded-tl-none px-4 py-2 shadow">
                                            @if($message->type === 'file')
                                                <div class="flex items-center space-x-3 bg-gray-100 rounded-lg p-3 mb-2">
                                                    <i class="fas fa-file-pdf text-red-600 text-2xl"></i>
                                                    <div class="flex-1">
                                                        <p class="text-sm font-medium text-gray-900">{{ $message->file_name ?? 'inspection_report.pdf' }}</p>
                                                        <p class="text-xs text-gray-600">{{ $message->file_size ?? '3.1 MB' }}</p>
                                                    </div>
                                                    <button class="text-indigo-600 hover:text-indigo-700">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </div>
                                            @endif
                                            <p class="text-sm text-gray-900">{{ $message->content ?? 'Hi! The property inspection has been scheduled for Nov 20th at 2:00 PM. Please confirm your availability.' }}</p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1 px-1">{{ $message->time ?? '10:30 AM' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <!-- System Message -->
                    <div class="flex justify-center my-4">
                        <div class="bg-blue-100 text-blue-800 rounded-lg px-4 py-2 text-xs max-w-md text-center">
                            <i class="fas fa-info-circle mr-1"></i>
                            Sarah Johnson shared a document: Property Inspection Report
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <div class="flex items-end space-x-2">
                    <!-- Attachment Button -->
                    <button class="text-gray-600 hover:text-gray-900 p-2 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-paperclip text-xl"></i>
                    </button>

                    <!-- Message Input -->
                    <div class="flex-1 relative">
                        <textarea rows="1" placeholder="Type your message..." class="w-full px-4 py-3 border border-gray-300 rounded-lg resize-none focus:ring-indigo-500 focus:border-indigo-500" style="max-height: 120px;"></textarea>
                        <button class="absolute bottom-3 right-3 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-smile text-xl"></i>
                        </button>
                    </div>

                    <!-- Send Button -->
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-lg">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>

                <!-- File Upload Preview (Hidden by default) -->
                <div id="file-preview" class="hidden mt-3 bg-gray-50 border border-gray-200 rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file text-gray-600 text-xl"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-900">filename.pdf</p>
                                <p class="text-xs text-gray-600">2.4 MB</p>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="flex items-center space-x-4 mt-3 text-xs text-gray-600">
                    <button class="hover:text-gray-900">
                        <i class="fas fa-image mr-1"></i> Image
                    </button>
                    <button class="hover:text-gray-900">
                        <i class="fas fa-file mr-1"></i> Document
                    </button>
                    <button class="hover:text-gray-900">
                        <i class="fas fa-calendar mr-1"></i> Schedule Meeting
                    </button>
                </div>
            </div>
        </div>

        <!-- Info Panel (Collapsible) -->
        <div class="w-80 border-l border-gray-200 overflow-y-auto bg-gray-50" x-data="{ showInfo: true }" x-show="showInfo">
            <div class="p-6">
                <!-- Contact Info -->
                <div class="text-center mb-6">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($active_chat->participant ?? 'Agent') }}&size=100" class="h-24 w-24 rounded-full mx-auto mb-3 border-4 border-white shadow-lg" alt="">
                    <h3 class="font-semibold text-gray-900">{{ $active_chat->participant ?? 'Sarah Johnson' }}</h3>
                    <p class="text-sm text-gray-600">{{ $active_chat->role ?? 'Senior Real Estate Agent' }}</p>
                </div>

                <!-- Contact Details -->
                <div class="space-y-3 mb-6">
                    <div class="flex items-center text-sm text-gray-700">
                        <i class="fas fa-phone w-5 mr-3 text-gray-400"></i>
                        <span>{{ $active_chat->phone ?? '+1 (555) 123-4567' }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-700">
                        <i class="fas fa-envelope w-5 mr-3 text-gray-400"></i>
                        <span>{{ $active_chat->email ?? 'sarah@agency.com' }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-700">
                        <i class="fas fa-building w-5 mr-3 text-gray-400"></i>
                        <span>{{ $active_chat->agency ?? 'Premier Realty' }}</span>
                    </div>
                </div>

                <!-- Shared Files -->
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-900 mb-3">Shared Files ({{ $shared_files_count ?? 8 }})</h4>
                    <div class="space-y-2">
                        @foreach($shared_files ?? [] as $file)
                            <div class="bg-white rounded-lg p-3 flex items-center space-x-3 hover:bg-gray-50 cursor-pointer">
                                <i class="fas fa-file-pdf text-red-600"></i>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $file->name ?? 'document.pdf' }}</p>
                                    <p class="text-xs text-gray-600">{{ $file->size ?? '2.4 MB' }} • {{ $file->date ?? 'Nov 15' }}</p>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <button class="mt-3 text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        View All Files <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>

                <!-- Related Properties -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-3">Related Properties</h4>
                    <div class="space-y-3">
                        @foreach($related_properties ?? [] as $property)
                            <div class="bg-white rounded-lg overflow-hidden hover:shadow cursor-pointer">
                                <img src="{{ $property->image ?? 'https://via.placeholder.com/300x150' }}" class="w-full h-24 object-cover" alt="">
                                <div class="p-3">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $property->title ?? '4 Bedroom Villa' }}</p>
                                    <p class="text-xs text-gray-600">{{ $property->location ?? 'Beverly Hills, CA' }}</p>
                                    <p class="text-sm font-bold text-indigo-600 mt-1">${{ number_format($property->price ?? 450000, 0) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-resize textarea
const textarea = document.querySelector('textarea');
if (textarea) {
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
}

// Scroll to bottom of messages
function scrollToBottom() {
    const messagesArea = document.querySelector('.overflow-y-auto.p-6');
    if (messagesArea) {
        messagesArea.scrollTop = messagesArea.scrollHeight;
    }
}
scrollToBottom();
</script>
@endsection
