<?php

namespace App\Services;

use App\Models\MessageFileAttachment;

class AttachmentFileUploadService
{
    // /**
    //  * @param array<UploadedFile> $files
    //  */
    public function upload($files, ?int $conversationMessageId): void
    {
        foreach ($files as $file) {
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {

                $finalName = "image"."-".time()."-".$originalName;
                $file->move(storage_path('app/public/messages/images/'), $finalName);

                MessageFileAttachment::create([
                    "conversation_message_id" => $conversationMessageId,
                    "type" => "image",
                    "attachment_path" => $finalName,
                ]);

            } elseif (in_array($extension, ['avi','mpeg','webm','mp4'])) {

                $finalName = "video"."-".time()."-".$originalName;
                $file->move(storage_path('app/public/messages/videos/'), $finalName);

                MessageFileAttachment::create([
                    "conversation_message_id" => $conversationMessageId,
                    "type" => "video",
                    "attachment_path" => $finalName,
                ]);

            } elseif (in_array($extension, ['pdf','msword','vnd.ms-excel','vnd','ms-powerpoint','plain','csv','zip','x-rar-compressed','x-7z-compressed'])) {

                $finalName = "file"."-".time()."-".$originalName;
                $file->move(storage_path('app/public/messages/files/'), $finalName);

                MessageFileAttachment::create([
                    "conversation_message_id" => $conversationMessageId,
                    "type" => "file",
                    "attachment_path" => $finalName,
                ]);

            } elseif (in_array($extension, ['mpeg','wav','ogg'])) {

                $finalName = "audio"."-".time()."-".$originalName;
                $file->move(storage_path('app/public/messages/audios/'), $finalName);

                MessageFileAttachment::create([
                    "conversation_message_id" => $conversationMessageId,
                    "type" => "audio",
                    "attachment_path" => $finalName,
                ]);
            }
        }
    }
}
