<?php

namespace Database\Seeders;

use App\Models\Fish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * DON'T CHANGE THE ORDER LIST OF FISH CLASS!!
         */
        $fishList = [
            [
                'name' => 'Bangus',
                'type' => 'Saltwater',
                'description' => 'Also known as milkfish, Bangus is the national fish of the Philippines. It has a streamlined, silver body and can grow up to a meter in length. It is prized for its mild flavor and tender white meat, making it a popular choice for various dishes such as sinigang and daing.',
                'food' => 'Bangus primarily feeds on algae and small invertebrates.'
            ],
            [
                'name' => 'Big Head Carp',
                'type' => 'Freshwater',
                'description' => 'The Big Head Carp is easily recognizable by its disproportionately large head compared to its body. Native to East Asia, this fish is known for its rapid growth and is a key species in aquaculture due to its efficiency in consuming zooplankton.',
                'food' => 'Big Head Carp primarily feeds on zooplankton and phytoplankton.'
            ],
            [
                'name' => 'Black Spotted Barb',
                'type' => 'Freshwater',
                'description' => 'Black Spotted Barb is a small, peaceful fish with a silvery body and distinct black spots scattered across its back and sides. It is often found in slow-moving rivers and streams, where it feeds on algae, small insects, and plant matter.',
                'food' => 'Black Spotted Barb feeds on algae, small insects, and plant matter.'
            ],
            [
                'name' => 'Catfish',
                'type' => 'Freshwater',
                'description' => 'Catfish are bottom-dwelling fish known for their whisker-like barbels around their mouth. They have a diverse diet, feeding on insects, small fish, algae, and organic debris found at the bottom of rivers, lakes, and ponds.',
                'food' => 'Catfish feed on insects, small fish, algae, and organic debris.'
            ],
            [
                'name' => 'Climbing Perch',
                'type' => 'Freshwater',
                'description' => 'Climbing Perch is a hardy fish species known for its ability to survive out of water for extended periods by breathing through its skin. It inhabits stagnant or slow-moving waters and feeds on insects, small fish, and crustaceans.',
                'food' => 'Climbing Perch feeds on insects, small fish, and crustaceans.'
            ],
            [
                'name' => 'Fourfinger Threadfin',
                'type' => 'Saltwater',
                'description' => 'Fourfinger Threadfin is a slender fish species with four distinct filaments extending from its tail fin. It is found in coastal waters and estuaries, where it feeds on small fish, crustaceans, and mollusks.',
                'food' => 'Fourfinger Threadfin feeds on small fish, crustaceans, and mollusks.'
            ],
            [
                'name' => 'Freshwater Eel',
                'type' => 'Freshwater',
                'description' => 'Freshwater Eel is a long, snake-like fish with a smooth, scaleless body. It is nocturnal and typically hides in burrows or crevices during the day. It feeds on small fish, insects, and crustaceans.',
                'food' => 'Freshwater Eel feeds on small fish, insects, and crustaceans.'
            ],
            [
                'name' => 'Glass Perchlet',
                'type' => 'Freshwater',
                'description' => 'Glass Perchlet is a small, transparent fish species with a slender body and silver coloration. It is found in clear, shallow waters and feeds on small invertebrates and aquatic larvae.',
                'food' => 'Glass Perchlet feeds on small invertebrates and aquatic larvae.'
            ],
            [
                'name' => 'Goby',
                'type' => 'Saltwater',
                'description' => 'Goby is a small, bottom-dwelling fish species with a flattened body and large eyes. It is known for its vibrant colors and can be found in coral reefs and rocky shores. Gobies feed on small crustaceans, worms, and plankton.',
                'food' => 'Goby feeds on small crustaceans, worms, and plankton.'
            ],
            [
                'name' => 'Gold Fish',
                'type' => 'Freshwater',
                'description' => 'Gold Fish is a popular ornamental fish known for its bright colors and distinctive body shapes. It originates from East Asia and is often kept in aquariums. Gold Fish are omnivorous, feeding on algae, small insects, and plant matter.',
                'food' => 'Gold Fish are omnivorous, feeding on algae, small insects, and plant matter.'
            ],
            [
                'name' => 'Gourami',
                'type' => 'Freshwater',
                'description' => 'Gourami is a peaceful fish species native to Southeast Asia. It has a labyrinth organ that allows it to breathe air, enabling it to survive in oxygen-depleted waters. Gouramis feed on insects, small crustaceans, and plant matter.',
                'food' => 'Gouramis feed on insects, small crustaceans, and plant matter.'
            ],
            [
                'name' => 'Grass Carp',
                'type' => 'Freshwater',
                'description' => 'Grass Carp is a herbivorous fish species known for its ability to consume large amounts of aquatic vegetation. It is widely used in aquaculture and for controlling excessive aquatic plant growth in lakes and ponds.',
                'food' => 'Grass Carp primarily feeds on aquatic vegetation.'
            ],
            [
                'name' => 'Green Spotted Puffer',
                'type' => 'Saltwater',
                'description' => 'Green Spotted Puffer is a small, colorful fish known for its ability to inflate itself when threatened. It inhabits coastal waters and coral reefs, where it feeds on small crustaceans, mollusks, and algae.',
                'food' => 'Green Spotted Puffer feeds on small crustaceans, mollusks, and algae.'
            ],
            [
                'name' => 'Indian Carp',
                'type' => 'Freshwater',
                'description' => 'Indian Carp, also known as Rohu, is a popular food fish in South Asia. It has a silver-colored body and is cultivated extensively in freshwater ponds and rivers. Indian Carp feeds on plankton, algae, and small invertebrates.',
                'food' => 'Indian Carp feeds on plankton, algae, and small invertebrates.'
            ],
            [
                'name' => 'Indo-Pacific Tarpon',
                'type' => 'Saltwater',
                'description' => 'Indo-Pacific Tarpon is a large, predatory fish species found in coastal waters and estuaries of the Indo-Pacific region. It has a streamlined body and feeds on small fish, crustaceans, and occasionally birds and mammals.',
                'food' => 'Indo-Pacific Tarpon feeds on small fish, crustaceans, and occasionally birds and mammals.'
            ],
            [
                'name' => 'Jaguar Gapote',
                'type' => 'Freshwater',
                'description' => 'Jaguar Gapote is a predatory fish species known for its distinctive black and yellow coloration resembling a jaguar pattern. It is native to South America and feeds on small fish, insects, and crustaceans.',
                'food' => 'Jaguar Gapote feeds on small fish, insects, and crustaceans.'
            ],
            [
                'name' => 'Janitor Fish',
                'type' => 'Freshwater',
                'description' => 'Janitor Fish, also known as Plecostomus, is a popular algae-eating fish species in aquariums. It has a flattened body and is known for its ability to clean algae and debris from tank surfaces.',
                'food' => 'Janitor Fish feeds on algae and debris.'
            ],
            [
                'name' => 'Knifefish',
                'type' => 'Freshwater',
                'description' => 'Knifefish is a nocturnal fish species known for its elongated, knife-like body. It inhabits slow-moving rivers and streams, where it feeds on small fish, insects, and crustaceans.',
                'food' => 'Knifefish feeds on small fish, insects, and crustaceans.'
            ],
            [
                'name' => 'Long-Snouted Pipefish',
                'type' => 'Saltwater',
                'description' => 'Long-Snouted Pipefish is a slender, elongated fish species found in shallow coastal waters and seagrass beds. It has a tubular snout and feeds on small crustaceans and planktonic organisms.',
                'food' => 'Long-Snouted Pipefish feeds on small crustaceans and planktonic organisms.'
            ],
            [
                'name' => 'Mosquito Fish',
                'type' => 'Freshwater',
                'description' => 'Mosquito Fish is a small, live-bearing fish species known for its ability to control mosquito larvae populations. It is widely distributed and thrives in various freshwater habitats, feeding on algae, small invertebrates, and mosquito larvae.',
                'food' => 'Mosquito Fish feeds on algae, small invertebrates, and mosquito larvae.'
            ],
            [
                'name' => 'Mudfish',
                'type' => 'Freshwater',
                'description' => 'Mudfish, also known as snakeheads, are predatory fish known for their elongated bodies and aggressive feeding habits. They inhabit freshwater environments and feed on small fish, insects, and crustaceans.',
                'food' => 'Mudfish feed on small fish, insects, and crustaceans.'
            ],
            [
                'name' => 'Mullet',
                'type' => 'Saltwater',
                'description' => 'Mullet is a group of fish species characterized by their elongated bodies and forked tails. They are found in coastal waters and estuaries worldwide. Mullet are omnivorous, feeding on algae, small crustaceans, and detritus.',
                'food' => 'Mullet are omnivorous, feeding on algae, small crustaceans, and detritus.'
            ],
            [
                'name' => 'Pangasius',
                'type' => 'Freshwater',
                'description' => 'Pangasius, also known as the Mekong giant catfish, is a large freshwater fish native to Southeast Asia. It has a silver-colored body and is an important food fish in the region. Pangasius primarily feeds on plankton and algae.',
                'food' => 'Pangasius primarily feeds on plankton and algae.'
            ],
            [
                'name' => 'Perch',
                'type' => 'Freshwater',
                'description' => 'Perch is a family of freshwater fish known for their spiny dorsal fins and colorful patterns. They are widespread across North America, Europe, and Asia. Perch feed on insects, small fish, and crustaceans.',
                'food' => 'Perch feed on insects, small fish, and crustaceans.'
            ],
            [
                'name' => 'Scat Fish',
                'type' => 'Freshwater',
                'description' => 'Scat Fish, also known as Scats, are small to medium-sized fish found in brackish and freshwater habitats. They have a laterally compressed body and are omnivorous, feeding on algae, small invertebrates, and plant matter.',
                'food' => 'Scat Fish are omnivorous, feeding on algae, small invertebrates, and plant matter.'
            ],
            [
                'name' => 'Silver Barb',
                'type' => 'Freshwater',
                'description' => 'Silver Barb is a peaceful fish species native to South Asia. It has a silver-colored body and is popular in community aquariums. Silver Barbs feed on algae, small insects, and plant matter.',
                'food' => 'Silver Barb feeds on algae, small insects, and plant matter.'
            ],
            [
                'name' => 'Silver Carp',
                'type' => 'Freshwater',
                'description' => 'Silver Carp is a large, herbivorous fish native to East Asia. It is known for its silver-colored body and robust growth rate. Silver Carp feed on plankton and aquatic vegetation.',
                'food' => 'Silver Carp feed on plankton and aquatic vegetation.'
            ],
            [
                'name' => 'Silver Perch',
                'type' => 'Freshwater',
                'description' => 'Silver Perch is a freshwater fish native to Australia. It has a silvery body and is popular in aquaculture and recreational fishing. Silver Perch feed on insects, small fish, and crustaceans.',
                'food' => 'Silver Perch feed on insects, small fish, and crustaceans.'
            ],
            [
                'name' => 'Snakehead',
                'type' => 'Freshwater',
                'description' => 'Snakehead is a predatory fish known for its elongated body and sharp teeth. Native to Africa and Asia, Snakeheads are aggressive hunters and feed on small fish, insects, and crustaceans.',
                'food' => 'Snakehead feeds on small fish, insects, and crustaceans.'
            ],
            [
                'name' => 'Tenpounder',
                'type' => 'Saltwater',
                'description' => 'Tenpounder, also known as Palometa, is a coastal marine fish species found in tropical and subtropical waters. It has a silver body with yellow accents and feeds on small fish and crustaceans.',
                'food' => 'Tenpounder feeds on small fish and crustaceans.'
            ],
            [
                'name' => 'Tilapia',
                'type' => 'Freshwater',
                'description' => 'Tilapia is a popular aquaculture fish known for its mild flavor and versatility. It originates from Africa and is now farmed globally. Tilapia feed on algae, plankton, and detritus.',
                'food' => 'Tilapia feed on algae, plankton, and detritus.'
            ],
        ];

        foreach ($fishList as $key => $item) {
            Fish::query()->create([
                'id' => $key,
                'name' => $item['name'],
                'type' => $item['type'],
                'description' => $item['description'],
                'food' => $item['food'],
            ]);
         }
    }
}
