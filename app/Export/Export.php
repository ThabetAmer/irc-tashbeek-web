<?php


namespace App\Export;


use Maatwebsite\Excel\Facades\Excel;

abstract class Export implements ExportInterface
{
    protected $data = [];

    protected $title = 'excel_title';


    /**
     * apply export functionality
     */
    public function apply()
    {
        $title = $this->getTitle();

        $headers = $this->getHeaders();

        $data = $this->getData();

        return Excel::create($title, function ($excel) use ($title, $headers, $data) {

            // Set the spreadsheet title
            $excel->setTitle($title);

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function ($sheet) use ($headers, $data) {
                $sheet->fromArray(array_merge([$headers], $data), null, 'A1', false, false);
            });

        })->download('xlsx');

    }

    /**
     * @param $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;

        return $this;
    }


    /**
     * @param string $title
     * @return $this
     */
    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

}
