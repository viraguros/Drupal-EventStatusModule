<?PHP

namespace Drupal\event_status\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\event_status\Services\EventStatusCalculator;

/**
 *  Test1 block
 * 
 * @block(
 *  id = "event_status",
 *  admin_label = "Display event status",
 * )
 */


 class event_status_block extends BlockBase {

    private $message;
    /**
     *  {@inheritdoc}
     */

     public function build() {

        $node = \Drupal::routeMatch()->getParameter('node');

        if($node instanceof \Drupal\node\NodeInterface) {
            if($node->getType() == "event"){

                $eventDate = $node->get("field_date")->getValue();
                $date = $eventDate[0]['value'];

                $this->message = \Drupal::service('event_status.calculate_status')->setStatusMsg($date);
            }
            else {
                $this->message = '';
            }
        }
        else {
            $this->message = '';
        }



        return [
            '#markup' => $this->t($this->message),
            '#cache' => ['max-age' => 0, ],
        ];
     }


 }


 