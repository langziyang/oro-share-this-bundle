<?php

namespace Jinber\Bundle\ShareThisBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
use Symfony\Component\HttpFoundation\ParameterBag;
/**
 * @ORM\Entity(repositoryClass="Jinber\Bundle\ShareThisBundle\Entity\Repository\ShareThisSettingsRepository")
 */
class ShareThisSettings extends Transport
{
    /**
     * ShareThis Property id
     * @ORM\Column(name="share_this_property_id",type="string",length=24)
     */
    private $propertyId;

    /**
     * display inline share
     * @ORM\Column(name="share_this_display_inline",type="boolean")
     */
    private $displayInline;

    /**
     * @var Collection|LocalizedFallbackValue[]
     * @ORM\ManyToMany(
     *     targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
     *     cascade={"ALL"},
     *     orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *     name="acme_coll_on_deliv_trans_label",
     *     joinColumns={@ORM\JoinColumn(name="transport_id",referencedColumnName="id",onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="localized_value_id",referencedColumnName="id",onDelete="CASCADE",unique=true)}
     * )
     */
    private $labels;

    /**
     * @var Collection|LocalizedFallbackValue[]
     *
     * @ORM\ManyToMany(
     *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
     *      cascade={"ALL"},
     *      orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *      name="acme_coll_on_deliv_short_label",
     *      joinColumns={
     *          @ORM\JoinColumn(name="transport_id", referencedColumnName="id", onDelete="CASCADE")
     *      },
     *      inverseJoinColumns={
     *          @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true)
     *      }
     * )
     */
    private $shortLabels;

    public function __construct()
    {
        $this->labels = new ArrayCollection();
        $this->shortLabels = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPropertyId()
    {
        return $this->propertyId;
    }

    /**
     * @param mixed $propertyId
     */
    public function setPropertyId($propertyId): self
    {
        $this->propertyId = $propertyId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDisplayInline()
    {
        return $this->displayInline;
    }

    /**
     * @param mixed $displayInline
     */
    public function setDisplayInline($displayInline): self
    {
        $this->displayInline = $displayInline;
        return $this;
    }

    public function getSettingsBag()
    {
        if (null===$this->settings){
            $this->settings=new ParameterBag([
                'labes'=>$this->getLabels(),
                'short_labels'=>$this->getShortLabels(),
            ]);
        }
        return $this->settings;
    }
    /**
     * @return Collection|LocalizedFallbackValue[]
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @param LocalizedFallbackValue $label
     *
     * @return $this
     */
    public function addLabel(LocalizedFallbackValue $label)
    {
        if (!$this->labels->contains($label)) {
            $this->labels->add($label);
        }

        return $this;
    }

    /**
     * @param LocalizedFallbackValue $label
     *
     * @return $this
     */
    public function removeLabel(LocalizedFallbackValue $label)
    {
        if ($this->labels->contains($label)) {
            $this->labels->removeElement($label);
        }

        return $this;
    }

    /**
     * @return Collection|LocalizedFallbackValue[]
     */
    public function getShortLabels()
    {
        return $this->shortLabels;
    }

    /**
     * @param LocalizedFallbackValue $label
     *
     * @return $this
     */
    public function addShortLabel(LocalizedFallbackValue $label)
    {
        if (!$this->shortLabels->contains($label)) {
            $this->shortLabels->add($label);
        }

        return $this;
    }

    /**
     * @param LocalizedFallbackValue $label
     *
     * @return $this
     */
    public function removeShortLabel(LocalizedFallbackValue $label)
    {
        if ($this->shortLabels->contains($label)) {
            $this->shortLabels->removeElement($label);
        }

        return $this;
    }
}