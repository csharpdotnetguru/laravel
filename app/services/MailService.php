<?php

/***
 * Class MailService
 */
class MailService
{
    protected $template;
    protected $html;
    protected $options = [];
    protected $template_is_fed = false;

    /***
     * You can directly pass a $template_code when instantiated
     * @param null $template_code
     */
    public function __construct($template_code = null)
    {
        if ($template_code)
            $this->setTemplate($template_code);
    }

    /***
     * Gets the template
     * @return EmailTemplate
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /***
     * Sets the template
     * @param $template_code
     * @return boolean
     */
    public function setTemplate($template_code)
    {
        // fetching template from database
        $template = EmailTemplate::where('template_code', '=', $template_code)->firstOrFail();

        if (!$template)
            return false;

        $this->template = $template;

        return true;
    }

    /***
     * Gets the rendered template (html)
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /***
     * Feeds template with $params content and sets the mail html
     * @param $params
     */
    public function feedTemplate($params)
    {
        $keys = array_keys($params);

        // appending $ to keys
        foreach ($keys as $i => $key) {
            $keys[$i] = '$' . $key;
        }

        $values = array_values($params);

        $html = str_replace($keys, $values, $this->template->template_body);

        $this->html = $html;
        $this->options = array_merge($this->options, $params);
        $this->template_is_fed = true;
    }

    /***
     * Queue the message
     * @param $options[email, title, firstname]
     * @return bool
     */
    public function queue($options)
    {
        if ((!isset($options['email'])) || (!isset($options['firstname'])) || (!isset($options['title'])))
            return false;

        // If template isn't fed yet, feed it with $options
        if (!$this->template_is_fed)
            $this->feedTemplate($options);

        // transfering only the needed properties to the closure
        // as queue has a 64kb limit: http://stackoverflow.com/a/21299503
        $from_name = Config::get('mail.from.name');
        $from_email = Config::get('mail.from.address');

        // Queuing email
        Mail::queue('email_wrapper', ['html' => $this->html],
            function ($message) use ($from_name, $from_email, $options) {
                $message->from($from_email, $from_name)
                        ->to($options['email'], $options['firstname'])
                        ->subject($options['title']);
            });

        return true;
    }

    public function preview($options)
    {
         $this->feedTemplate($options);

         return View::make('email_wrapper')
            ->with('html',$this->html);
    }

}