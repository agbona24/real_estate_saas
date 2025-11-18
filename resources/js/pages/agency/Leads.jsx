import React from 'react';
import {
    Box,
    Button,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    IconButton,
    useColorModeValue,
    HStack,
    Avatar,
    VStack,
    Text,
    Select,
} from '@chakra-ui/react';
import { Plus, Edit, Trash2, Eye, UserPlus } from 'lucide-react';

const Leads = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const leads = [
        {
            id: 1,
            name: 'Amanda Wilson',
            email: 'amanda.w@email.com',
            phone: '+1 (555) 111-2222',
            source: 'Website',
            interest: 'Buying',
            budget: '$400K - $500K',
            assignedTo: 'Sarah Johnson',
            status: 'new',
            date: '2025-11-18',
        },
        {
            id: 2,
            name: 'Thomas Brown',
            email: 'thomas.b@email.com',
            phone: '+1 (555) 222-3333',
            source: 'Referral',
            interest: 'Selling',
            budget: '$600K - $700K',
            assignedTo: 'Michael Chen',
            status: 'contacted',
            date: '2025-11-17',
        },
        {
            id: 3,
            name: 'Patricia Garcia',
            email: 'patricia.g@email.com',
            phone: '+1 (555) 333-4444',
            source: 'Facebook',
            interest: 'Buying',
            budget: '$300K - $400K',
            assignedTo: 'David Kim',
            status: 'qualified',
            date: '2025-11-16',
        },
        {
            id: 4,
            name: 'Christopher Lee',
            email: 'chris.l@email.com',
            phone: '+1 (555) 444-5555',
            source: 'Google Ads',
            interest: 'Renting',
            budget: '$2K - $3K/mo',
            assignedTo: 'Jessica Martinez',
            status: 'viewing_scheduled',
            date: '2025-11-15',
        },
        {
            id: 5,
            name: 'Michelle Davis',
            email: 'michelle.d@email.com',
            phone: '+1 (555) 555-6666',
            source: 'Walk-in',
            interest: 'Buying',
            budget: '$500K+',
            assignedTo: null,
            status: 'new',
            date: '2025-11-18',
        },
        {
            id: 6,
            name: 'James Rodriguez',
            email: 'james.r@email.com',
            phone: '+1 (555) 666-7777',
            source: 'Website',
            interest: 'Selling',
            budget: '$450K - $550K',
            assignedTo: 'Sarah Johnson',
            status: 'lost',
            date: '2025-11-10',
        },
    ];

    const getStatusColor = (status) => {
        const colors = {
            new: 'purple',
            contacted: 'blue',
            qualified: 'green',
            viewing_scheduled: 'cyan',
            negotiating: 'orange',
            lost: 'red',
        };
        return colors[status] || 'gray';
    };

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Leads</Heading>
                <HStack spacing={3}>
                    <Select placeholder="Filter by status" w="200px">
                        <option value="new">New</option>
                        <option value="contacted">Contacted</option>
                        <option value="qualified">Qualified</option>
                        <option value="viewing_scheduled">Viewing Scheduled</option>
                        <option value="negotiating">Negotiating</option>
                        <option value="lost">Lost</option>
                    </Select>
                    <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                        Add Lead
                    </Button>
                </HStack>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Lead</Th>
                            <Th>Contact</Th>
                            <Th>Source</Th>
                            <Th>Interest</Th>
                            <Th>Budget</Th>
                            <Th>Assigned To</Th>
                            <Th>Status</Th>
                            <Th>Date</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {leads.map((lead) => (
                            <Tr key={lead.id}>
                                <Td fontWeight="semibold">{lead.name}</Td>
                                <Td>
                                    <VStack align="start" spacing={0}>
                                        <Text fontSize="sm">{lead.email}</Text>
                                        <Text fontSize="sm" color="gray.500">
                                            {lead.phone}
                                        </Text>
                                    </VStack>
                                </Td>
                                <Td>
                                    <Badge>{lead.source}</Badge>
                                </Td>
                                <Td>{lead.interest}</Td>
                                <Td fontSize="sm">{lead.budget}</Td>
                                <Td>
                                    {lead.assignedTo ? (
                                        <Text fontSize="sm">{lead.assignedTo}</Text>
                                    ) : (
                                        <Button
                                            size="xs"
                                            leftIcon={<UserPlus size={14} />}
                                            colorScheme="blue"
                                            variant="outline"
                                        >
                                            Assign
                                        </Button>
                                    )}
                                </Td>
                                <Td>
                                    <Badge colorScheme={getStatusColor(lead.status)}>
                                        {lead.status.replace('_', ' ')}
                                    </Badge>
                                </Td>
                                <Td fontSize="sm">{lead.date}</Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Eye size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="View lead"
                                        />
                                        <IconButton
                                            icon={<Edit size={16} />}
                                            size="sm"
                                            colorScheme="green"
                                            variant="ghost"
                                            aria-label="Edit lead"
                                        />
                                        <IconButton
                                            icon={<Trash2 size={16} />}
                                            size="sm"
                                            colorScheme="red"
                                            variant="ghost"
                                            aria-label="Delete lead"
                                        />
                                    </HStack>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default Leads;
