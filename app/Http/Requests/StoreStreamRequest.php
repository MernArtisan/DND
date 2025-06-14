<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStreamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'stream_id'        => 'required|unique:streams,stream_id',
            'channel_id'       => 'required|exists:channels,id',
            'team_1'           => 'required|string',
            'team1_symbol'     => 'nullable|string',
            'team_2'           => 'required|string',
            'team2_symbol'     => 'nullable|string',
            'category_id'      => 'required|exists:categories,id',
            'title'            => 'required|string',
            'date'             => 'required|date',
            'start_time'       => 'required',
            'end_time'         => 'required',
            'location'         => 'nullable|string',
            'location_symbol'  => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description'      => 'nullable|string',
            'status'           => 'nullable|in:pending,live,ended'
        ];
    }
}
