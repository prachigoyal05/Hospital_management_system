<?php
use App\Models\Patient;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PatientsImport implements ToCollection, WithHeadingRow
{
    private $successCount = 0;
    private $errors = [];
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $row = $row->toArray();
            
            // Skip rows that don't have the expected structure
            if (!isset($row['Name']) && !isset($row['name'])) {
                $this->errors[] = "Row ".($index+1).": Missing required 'Name' column";
                continue;
            }

            // Map the row data to expected fields
            $data = [
                'name' => $row['Name'] ?? $row['name'] ?? null,
                'email' => $row['Email'] ?? $row['email'] ?? null,
                'phone' => $row['Phone'] ?? $row['phone'] ?? null,
                'date_of_birth' => $row['Date of Birth'] ?? $row['Date_of_Birth'] ?? $row['date_of_birth'] ?? $row['dob'] ?? null,
                'address' => $row['Address'] ?? $row['address'] ?? null,
            ];

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|unique:patients,email',
                'phone' => 'nullable|string|max:20',
                'date_of_birth' => 'nullable|date|before_or_equal:today',
                'address' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                $this->errors[] = "Row ".($index+1).": ".implode(', ', $validator->errors()->all());
                continue;
            }

            try {
                Patient::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'dob' => $data['date_of_birth'] ? Carbon::parse($data['date_of_birth'])->format('Y-m-d') : null,
                    'address' => $data['address'],
                    'is_active' => true
                ]);
                
                $this->successCount++;
            } catch (\Exception $e) {
                $this->errors[] = "Row ".($index+1).": ".$e->getMessage();
            }
        }
    }
    
    public function getSuccessCount() { 
        return $this->successCount; 
    }
    
    public function getErrors() { 
        return $this->errors; 
    }
}